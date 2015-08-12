<?php
/**
* @file Base.php
* @brief controller base class
* @author haoyankai
* @version 1.0
* @date 2015-07-20
 */

namespace Vine\Component\Controller;

abstract class Base
{/*{{{*/

    /**  
     * @var string current module name.
     */
    protected $moduleName;

    /**  
     * @var string current controller name.
     */
    protected $controllerName;

    /**  
     * @var current action name.
     */
    protected $actionName;

    /**  
     * @var \Vine\Component\View\ViewInterface the view used to render template.
     */
    protected $view;

    /**  
     * @var \Vine\Component\Http\RequestInterface request object.
     */
    protected $request;

    /**  
     * Constructor.
     * moduleName, controllerName, actionName is set in this method.
     * @param string $moduleName module name.
     * @param string $controllerName controller name.
     * @param string $actionName action name.
     */
    public function __construct($moduleName, $controllerName, $actionName)
    {/*{{{*/
        $this->moduleName     = lcfirst($moduleName);
        $this->controllerName = $controllerName;
        $this->actionName     = $actionName;
    }/*}}}*/

    /**
     * set view object which is used to render template.
     * @param \Vine\Component\View\ViewInterface $view view object.
     * @return this
     */
    public function setView(\Vine\Component\View\ViewInterface $view = null)
    {/*{{{*/
        $this->view = $view;

        return $this;
    }/*}}}*/

    /**
     * set request object.
     * NOTE:Request object is needed in action methods.
     * We should guarantee this method is called before that.
     * @param \Vine\Component\Http\RequestInterface $request request object.
     * @return this
     */
    public function setRequest(\Vine\Component\Http\RequestInterface $request)
    {/*{{{*/
        $this->request = $request;

        return $this;
    }/*}}}*/


    /**
     * assign data into template.
     * @see \Vine\Component\View\ViewInterface::assign() for detail information.
     * @param string $key data key.
     * @param mixed $value data value.
     * @param bool $secureFilter whether to filter data or not, for security issues.
     */
    protected function assign($key, $value, $secureFilter = true)
    {/*{{{*/
        $this->view->assign($key, $value, $secureFilter);
    }/*}}}*/

    /**
     * render data into template, set generated html into response object, then return response.
     * @param string $tpl template name.
     * @param boolean $withViewSuffix.
     * @return \Vine\Component\Http\ResponseInterface
     */
    protected function render($tpl, $withViewSuffix = false)
    {/*{{{*/
        $content = $this->view->render($tpl, $withViewSuffix);

        return new \Vine\Component\Http\Response($content);
    }/*}}}*/

    /**
     * render data into auto template, set generated html into response object, then return response.
     * @return \Vine\Component\Http\ResponseInterface
     */
    protected function autoRender()
    {/*{{{*/
        $tpl = $this->moduleName.'/'.$this->controllerName.'/'.$this->actionName;

        return $this->render($tpl, false);
    }/*}}}*/
}/*}}}*/
