<?php

class Svn
{

    var $baseUrl;

    var $modelLog;
    
    var $environment = '';

    public function __construct($baseUrl, $isLinux = true)
    {
        $this->baseUrl = $baseUrl;
        $this->modelLog = new Loc();
        
        if ($isLinux) {
            $this->environment = ' --no-auth-cache 2>&1';
        }
    }

    public function svnDiffEachVersion(&$debug, &$aryLog, $aryAccountFilter = array())
    {
        $count = 0;
        $r1 = 0;
        $r2 = 0;
        
        // get first revision
        foreach ($aryLog as $row) {
            if (count($aryAccountFilter) > 0) {
                // check account
                if (in_array($row['u'], $aryAccountFilter)) {
                    $r1 = $row['r'];
                    break;
                }
            } else {
                $r1 = $row['r'];
                break;
            }
        }
        
        // get next revision
        foreach ($aryLog as $row) {
            if ($row['r'] == $r1)
                continue;
                
                // check account
            if (in_array($row['u'], $aryAccountFilter) || empty($aryAccountFilter)) {
                $r2 = $row['r'];
                
                // diff revision
                $urlDiff = 'svn diff -r ' . $r1 . ':' . $r2 . ' ' . $this->baseUrl . $this->environment;
                $output = array();
                exec($urlDiff, $output);
                
                // write log output
                $debug[] = $output;
                
                $cnt = $this->modelLog->getCountLine($output);
                $count += $cnt;
                $r1 = $r2;
            } else {
                $r1 = $row['r'];
            }
        }
        
        return $count;
    }
    
    public function svnDiff($r1, $r2, &$outputAll) {
        $count = 0;
        //diff revision
        $urlDiff = 'svn diff -r '. $r1 .':'. $r2 .' '. $this->baseUrl . $this->environment;
        $output = array();
        exec($urlDiff, $output);
        //write log output
        $outputAll[] = $output;
        return $this->modelLog->getCountLine($output);
    }

    public function exportRevisionLog($vs, $ve)
    {
        $logs = array();
        exec("svn log -r " . $vs . ":" . $ve . " " . $this->baseUrl . $this->environment, $logs);
        
        $aryLog = array();
        $idx = 0;
        foreach ($logs as $row) {
            if (strlen($row) > 2 && $row{0} == 'r' && is_numeric($row{1})) {
                $aryTemp = explode(' | ', $row);
                // get revision
                $revision = substr($aryTemp[0], 1, strlen($aryTemp[0]));
                $username = $aryTemp[1];
                $aryLog[$idx]['r'] = $revision;
                $aryLog[$idx]['u'] = $username;
                
                $idx ++;
            }
        }
        return $aryLog;
    }
}
