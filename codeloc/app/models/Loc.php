<?php

class Loc
{
    public function getCountLine(&$output)
    {
        $cnt = 0;
        $aryCheck = array();
        $id = 0;
        $k = 0;
        $isCommentFunction = false;
        
        foreach ($output as $key => $row) {
            error_log($row . "\n",3,'/tmp/log.txt');
            if ((@$row{0} == '+' && @$row{1} != '+') || (@$row{0} == '-' && @$row{1} != '-')) {
                if ($k != 0 && ($k + 1) != $key) {
                    $id ++;
                }
                
                // loc comment
                if (! $isCommentFunction) {
                    $isCommentFunction = $this->checkCommentFunction($row, true);
                } else {
                    if ($this->checkCommentFunction($row, false)) {
                        $isCommentFunction = false;
                    }
                    $k = $key;
                    continue;
                }
                
                // check comemnt single
                if ($this->checkComment($row)) {
                    $k = $key;
                    continue;
                }
                
                $offset = $row{0};
                @$aryCheck[$id][$offset] ++;
                $k = $key;
            }
        }
        
        foreach ($aryCheck as $key => $value) {
            $cnt += max($value);
        }
        
        return $cnt;
    }

    private function checkCommentFunction($str, $isStart = false)
    {
        $str = trim(substr($str, 1));
        if ($isStart) {
            // check /*
            if (strpos($str, '/*') === 0 && strpos($str, '*/') === false) {
                return true;
            }
            return false;
        } else {
            // check */
            if (strpos($str, '*/') !== FALSE) {
                return true;
            }
            return false;
        }
    }
    
    private function checkComment($str) {
        $str = trim(substr($str, 1));
        if(strpos($str, '/') === 0 || strpos($str, '{*') === 0 || strpos($str, '<%*') === 0) {
            return true;
        }
    
        //check row null
        if(empty($str)) {
            return true;
        }
        return false;
    }
}
