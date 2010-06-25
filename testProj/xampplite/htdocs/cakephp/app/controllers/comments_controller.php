﻿<?php

class CommentsController extends AppController {

    var $name = "Comments";
	var $components = array('XmlBuilder','Session','RequestHandler');
	var $helpers = array('Xml');

    function index() {
	
		// URL Beispiele
		// http://localhost/cakephp/comments?id=2
		// http://localhost/cakephp/comments?photoid=1
		// http://localhost/cakephp/comments?id=1&photoid=1
		
		echo "DEBUGGING <br />-------------<br />";
		
		$allowedQryParams = array(
			"id"=>"id",
			"photoid"=>"photo_id"
			);
		$allowedCtrlParams = array(
			"apikey" => "",
			"format" => array("xml","json")
			);
			
		$invalidParams=false;
		$model = " ";
		$urlParams = array();
		
		$parsedParams["format"]="html";
		$parsedParams["urlparams"]=array();
		
		foreach ($this->params['url'] as $key => $val) {
			if ($key=="url") {
				$model=ucfirst(preg_replace('/[^a-z]/','',strtolower($val))); // first letter uppercase
				$model=substr($model,0,strlen($model)-1);
			}
			else {
				$key = strtolower($key);
				
				if (array_key_exists($key, $allowedQryParams))
				{
					$val = preg_replace('/[^a-zA-Z0-9öÖüÜäÄß_]/','',$val);
					$urlParams = array_merge($urlParams,array(array($model.'.'.$key => $val)));
				}
				else 
				{
					if (array_key_exists($key, $allowedCtrlParams)) 
					{
						switch($key) {
							case "format":
							{
								if (in_array($val, $allowedCtrlParams["format"]))
								{
									$parsedParams["format"] = $val;
									if ($this->params['url']['ext']) $this->params['url']['ext'] = $parsedParams["format"];
								}
								else 
									$invalidParams = true;	
								break;
							}
								
							case "apikey":
							{ 	//TODO
								echo $key . " = " . $val . "<br />";
								break;
							}
						}
					}
					else 
					{
						if ($key != 'ext') $invalidParams=true; //if Routes w/ Router::parseExtensions()
					}
				}
			}
		}
		
		if (!$invalidParams)
		{
			// creating $parsedParams["urlparams"] for conditions/where-clause
			if ($urlParams) 
			{
				$parsedParams["urlparams"] = array('AND' => $urlParams);
				echo var_dump($parsedParams["urlparams"])."<br />";
			}
			
			// conditions/where-clause available OR null
			if ($parsedParams["urlparams"])
				$conditions = array('AND' => array(
					$parsedParams["urlparams"]
					));
			else $conditions = null; 
				
			// db request
			$result = $this->Comment->find('all', array(
				'conditions' => $conditions,
			));
			
			switch ($parsedParams["format"]) 
			{
				case "html": 
				{
					echo "<br />STATUS:<b><font color='green'>&nbsp;OK</font><b><br /><br />";
					$this->set("results",$result);
					break;
				}
				case "json":
					//TODO
					break;
				default: //="xml"
					//TODO
					$this->set("results",null);
					$b = $this->XmlBuilder->buildComment();
					$this->set("resultsx",$result);
					//$this->render('/comments/xml');
					break;
			}
		}
		else
		{
			echo "<br />STATUS:<b><font color='red'>&nbsp;INVALID-PARAMS !!</font><b><br /><br />";
			$this->set("results",null);
		}
	}
	
}
?>
