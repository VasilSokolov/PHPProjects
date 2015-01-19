<?php

/* LoginLoginBundle:Default:login.html.twig */
class __TwigTemplate_c0f7fb9ec1e40b6ce4582f36c83a4f40432f428bb0793d7228d0ca3675a218d4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        try {
            $this->parent = $this->env->loadTemplate("LoginLoginBundle:Default:index.html.twig");
        } catch (Twig_Error_Loader $e) {
            $e->setTemplateFile($this->getTemplateName());
            $e->setTemplateLine(1);

            throw $e;
        }

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'container' => array($this, 'block_container'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "LoginLoginBundle:Default:index.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 3
        echo "    <style type=\"text/css\">
        body{
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #fbeed5;
        }

        .form-signin{
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #D3D3D3;
            border: 1px solid #fbeed5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            -moz-border-radius: 0 1px 2px rgba(0,0,0,.05);
            border-radius: 0 1px 2px rgba(0,0,0,.05);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox{
            margin-bottom: 10px;
        }
        .form-signin input[type=\"text\"],
        .form-signin input[type=\"password\"]{
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
        }
    </style>

";
    }

    // line 37
    public function block_container($context, array $blocks = array())
    {
        // line 38
        echo "    <div class=\"container\">
        
        <form class=\"form-signin\" method='POST' action=\"";
        // line 40
        echo $this->env->getExtension('routing')->getPath("login_login_homepage");
        echo "\" data-validate='parsley'>
            <h2 class=\"form-signin-heading\">Please Sign In</h2>
            <input type='text' id='username' class='input-block-level' name='username' placeholder='UserName' data-trigger='change' data-required='true'  />
            <input type='password' class='input-block-level' name='password' placeholder='Password' data-trigger='change' data-required='true' />                        
            <label class='chechbox'>
                <input type='checkbox' name='remember' value='remember-me' />Remember me
            </label>
            <button type='submit' class='btn btn-large btn-primary'>Sign In</button>
            <a href='";
        // line 48
        echo $this->env->getExtension('routing')->getPath("login_login_signup");
        echo "'>Sign Up</a> 
        </form>
    </div
    ";
        // line 51
        if (array_key_exists("name", $context)) {
            // line 52
            echo "    <div class=\"alert-info fade in\">
        <strong>";
            // line 53
            echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
            echo "</strong>
    </div>
    ";
        }
    }

    public function getTemplateName()
    {
        return "LoginLoginBundle:Default:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  106 => 53,  103 => 52,  101 => 51,  95 => 48,  84 => 40,  80 => 38,  77 => 37,  40 => 3,  37 => 2,  11 => 1,);
    }
}
