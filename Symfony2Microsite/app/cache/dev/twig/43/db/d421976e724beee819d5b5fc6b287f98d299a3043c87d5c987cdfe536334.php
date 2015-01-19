<?php

/* LoginLoginBundle:Default:signup.html.twig */
class __TwigTemplate_43dbd421976e724beee819d5b5fc6b287f98d299a3043c87d5c987cdfe536334 extends Twig_Template
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
    public function block_container($context, array $blocks = array())
    {
        // line 3
        echo "    <div class=\"container\" data-validate='parsley'>
        
        <form id='form' class='well' method='POST' action=\"";
        // line 5
        echo $this->env->getExtension('routing')->getPath("login_login_signup");
        echo "\">
            <h2 class=\"form-signin-heading\">Sign Up</h2>
            <label>Firstname</label>
            <input type='text' class='input-xlarge' name='firstname' data-trigger='change' data-required='true'/>            
            <label>Username</label>
            <input type='text' class='input-xlarge' name='username' data-trigger='change' data-required='true'/>
            <label>Password</label>   
            <input type='password' id='password' class='input-xlarge' name='password' data-trigger='change' data-required='true'/>
            <label>Confirm Password</label>   
            <input type='password' id='confirmPassword' class='input-xlarge' name='confirmPassword' data-trigger='change' data-required='true' data-equalto='#password'/>
            <label>Email</label>   
            <input type='email' class='input-xlarge' name='email' data-trigger='change' data-required='true' data-type='email'/>
            <label>Comments</label>
            <textarea type='textarea' class='input-xlarge' name='comments' ></textarea>                        
            <div>
            <button type='submit' class='btn btn-primary' type='submit'>Create Account</button>
            </div>
        </form>
    </div>
        
<script>
    \$(function(){
        \$('#confirmPassword').blur(function(){
            var passValue = \$('#password').val();
            var confirmValue = \$('#confirmPassword').val();
            
            if(passValue !== confirmValue) {
                \$(this).css({'color':'red'});
            } else {
                \$(this).css({'color':'green'});
            }
            
        });
    });
</script>
";
    }

    public function getTemplateName()
    {
        return "LoginLoginBundle:Default:signup.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 5,  39 => 3,  36 => 2,  11 => 1,);
    }
}
