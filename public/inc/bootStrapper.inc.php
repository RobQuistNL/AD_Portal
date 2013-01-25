<?php
/* 
 * Bootstrapper is a class to easily create bootstrap components.
*/
class BootStrapper 
{
    
    /**
     * Returns a bootstrap Hero unit.
     *
     * @param string $title <The header text of the unit>
     * @param string $content <The content text of the unit>
     * @return string <HTML formatted code>
     */
    public function heroUnit($title , $content) 
    {
        return '<div class="hero-unit">
        <h1>' . $title . '</h1>
        <p>' . $content . '</p>
        </div>';
    }
    
    /**
     * Returns a bootstrap row DIV - to be filled with spans (see block method).
     *
     * @param string $content <The content text of the row>
     * @return string <HTML formatted code>
     */
    public function row($content) 
    {
        return '<div class="row">' . $content . '</div>';
    }
    
    /**
     * Returns a bootstrap error DIV.
     *
     * @param string $content <The content text of the error div>
     * @return string <HTML formatted code>
     */
    public function errormessage($content) 
    {
        return '<div class="alert alert-error">' . $content . '</div>';
    }
    
    /**
     * Returns a bootstrap success DIV.
     *
     * @param string $content <The content text of the success div>
     * @return string <HTML formatted code>
     */
    public function successmessage($content) 
    {
        return '<div class="alert alert-success">' . $content . '</div>';
    }
    
    /**
     * Returns a bootstrap block div. Use inside the row method.
     *
     * @param int $size <The size in blocks of the block. Bootstrap default max = 12>
     * @param string $content <The contents of the block>
     * @return string <HTML formatted code>
     */
    public function block($size , $content) 
    {
        return '<div class="span' . $size . '">' . $content . '</div>';
    }
    
    /**
     * Returns a simple bootstrap login form.
     *
     * @param string $usernametext  <Text / name for username field>
     * @param string $passwordtext  <Text / name for password field>
     * @param string $signintext    <Text inside signin button>
     * @param string $action        <The action URL of the form>
     * @return string <HTML formatted code>
     */
    public function loginForm ($usernametext , $passwordtext , $signintext , $action) 
    {
        return '<form class="form-horizontal" method="post" action="' . $action . '">
                  <div class="control-group">
                    <label class="control-label" for="inputUsername">' . $usernametext . '</label>
                    <div class="controls">
                      <input name="username" type="text" id="inputUsername" placeholder="' . $usernametext . '">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="inputPassword">' . $passwordtext . '</label>
                    <div class="controls">
                      <input name="password" type="password" id="inputPassword" placeholder="' . $passwordtext . '">
                    </div>
                  </div>
                  <div class="control-group">
                    <div class="controls">
                      <!--<label class="checkbox">
                        <input type="checkbox"> Remember me
                      </label>-->
                      <button type="submit" class="btn">' . $signintext . '</button>
                    </div>
                  </div>
                </form>';
    }
    
}