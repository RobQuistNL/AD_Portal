<?php
/*
 * TemplateParser reads in a templatefile, which has some variables in it.
 * Those variables will be replaced with content from the class.
 *
*/
class SimpleTemplateParser
{

    private $content;
    private $title;
    private $templateFile = '';

    private $isParsed = false;

    private $parsevars = array();

    /**
     * Construction function - initializes the parseable variables.
     */
    public function __construct()
    {
        $this->initParseVars();
    }

    /**
     * Assign all variables from this class to strings.
     * Those strings will be replaced with the values in the Parse-method.
     */
    private function initParseVars()
    {
        /* Add some default values to be parsed. Can be edited for lateron */
        $this->parsevars = array(
                                'CONTENT'   => $this->content,
                                'TITLE'     => $GLOBALS['config']['project_title'] . ' - ' . $this->title,
                                );
    }

    /**
     * Set the template file.
     *
     * @param string $file   <filename in template path or absolute path>
     */
    public function setTemplate($file)
    {
        $this->templateFile = $file;
    }

    /**
     * Set the content variable in this object.
     *
     * @param string $string
     */
    public function setContent($string)
    {
        $this->content = $string;
    }

    /**
     * Set the title variable in this object.
     *
     * @param string $string
     */
    public function setTitle($string)
    {
        $this->title = $string;
    }

    /**
     * Append text to the content variable in this object.
     *
     * @param string $string
     */
    public function appendContent($string)
    {
        $this->content .= $string;
    }

    /**
     * Prepend text to the content variable in this object.
     *
     * @param string $string
     */
    public function prependContent($string)
    {
        $this->content = $string . $this->content;
    }

    /**
     * Add a variable to the template engine
     *
     * @param string $key
     * @param multi $value
     * @return SimpleTemplateParser this
     */
    public function setParsevar($key, $value)
    {
    	$this->parsevars[$key] = $value;
    	return $this;
    }
    
    /**
     * Clear a variable
     *
     * @param string $key
     * @return SimpleTemplateParser this
     */
    public function clearParsevar($key)
    {
    	if (array_key_exists($key, $this->parsevars)) unset($this->parsevars[$key]);
    	return $this;
    }
    
    /**
     * Parser function loads in the template file, and replaces all
     * placeholders in the file (e.g. {{PLACEHOLDER}} ) with the
     * assigned values in the $parsevars array. "PLACEHOLDER" in the array
     * will replace {{PLACEHOLDER}} in the file.
     */
    public function parse()
    {
        if ($this->templateFile=='') {
            throw new Exception('No template file selected.');
        }
		
        //Check if it exists in template folder or absolute
		if (!file_exists($this->templateFile)) {
        	$templateFilePath = $GLOBALS['config']['app_root'] . $GLOBALS['config']['template_folder'] . '/' . $this->templateFile;
		} else {
			$templateFilePath = $this->templateFile;
		}
		
		if (!file_exists($templateFilePath)) {
			throw new Exception('Template file ' . $templateFilePath . ' not found.');
		}
		
		$this->output = file_get_contents($templateFilePath);
        
        $this->initParseVars();

        foreach ($this->parsevars as $key => $value) {
            $this->output = str_replace('{{' . $key . '}}', $value, $this->output);
        }
        
        $this->isParsed = true;

    }

    /**
     * If the template is not yet parsed, parse it.
     * Then return the complete output of this class.
     *
     * @return string <The complete output of the parsed template>
     */
    public function getOutput()
    {

        if (!$this->isParsed) {
            $this->parse();
        }

        return $this->output;
    }

}