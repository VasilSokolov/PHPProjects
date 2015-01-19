<?php

/* LoginLoginBundle:Default:welcome.html.twig */
class __TwigTemplate_a2d9755f21bca09b01976a384514f9d17059b3750ab42d30b23b439d8051ac3f extends Twig_Template
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
        echo "    
";
    }

    // line 5
    public function block_container($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"container\">
        <h2>Hello ";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")), "html", null, true);
        echo "</h2>
    </div
    <a href='";
        // line 9
        echo $this->env->getExtension('routing')->getPath("login_login_logout");
        echo "'>Logout</a> 
";
    }

    public function getTemplateName()
    {
        return "LoginLoginBundle:Default:welcome.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 9,  51 => 7,  48 => 6,  45 => 5,  40 => 3,  37 => 2,  11 => 1,);
    }
}
