<?php
    class MY_Loader extends CI_Loader
    {
        public function template($template_name, $vars = array(), $return = false, $sidebar = false)
        {
            if ($return):
        $content  = $this->view('include/header', $vars, $return);
            if ($sidebar) {
                $content  = $this->view('include/sidebar', $vars, $return);
            }
            $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('include/footer', $vars, $return);

            return $content; else:
        $this->view('include/header', $vars);
            if ($sidebar) {
                $content  = $this->view('include/sidebar', $vars);
            }
            $this->view($template_name, $vars);
            $this->view('include/footer', $vars);
            endif;
        }
    }
