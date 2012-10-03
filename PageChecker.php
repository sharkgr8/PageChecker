<?php
/**
 * Project Name PageChecker 
 * Project Page https://github.com/sharkgr8/PageChecker
 * Description This extension is a simple behavior component that is attached to your 'web application' to check whether the current * page is the specified page or not.
 * @author Syed Sharique <shariqueit@yahoo.com>
 * @version 1.1
 */

class PageChecker extends CBehavior {
	

	/**
	 * Checks whether the specified page is currently shown by our application
	 * @param mixed the page to be checked for. You could pass pre-defined values for this parameter are the following:
	 *				-	`homepage` ---> To check for homepage
	 *				-	`contact` ---> To check for contact page
	 *				-	`about`   ---> To check for about us page
	 *				-	`login`   ---> To check for login page
	 * You could also pass the controller route in this parameter.
	 * @return boolean whether the current page is the specified page
	 */
	public function checkSpecifiedPage($page = 'homepage') {
		
		if(!empty($page))
		{
			
			//Normalizes the page url
			$url = CHtml::normalizeUrl($page);
			$pageUrl = '';
			
			//if the url passed is the string from the pre-defined keywords
			switch($url){
				case 'homepage':
					$pageUrl = array('site/index'); //set the homepage url
					break;
				case 'contact':
					$pageUrl = array('site/contact'); //set the contact page url
					break;
				case 'about':
					$pageUrl = array('site/page'); //set the about url
					break;
				case 'login':
					$pageUrl = array('site/login'); //set the login url
					break;
			}
			
			if(empty($pageUrl)){
				$url = str_replace(Yii::app()->baseURL.'/index.php/','',$url);
				
				//To account for url rewriting to remove site from the url
				$pos = strpos($url,'/');
				if($pos===false)
					$url = 'site/'.$url;
					
				//if the passed value for page parameter is the controller route
				$pageUrl = array($url); 
			}
			
			if(sizeof($pageUrl)==1){
				//Get the current page route
				$route=Yii::app()->controller->getRoute();
				
				//now check whether the specified url is active or not
				return $this->isPageActive($pageUrl,$route);
			}
		}
		return false;
		
	}
	
	/**
	 * Checks whether the specified page url is the same as that of the current page.
	 * This is done by checking if the currently requested URL is same as the requested route url.
	 * Note that the GET parameters not specified in the 'url' option will be ignored.
	 * @param array $url the page url to be checked
	 * @param string $route the route of the current request
	 * @return boolean whether the page url is active
	 */
	protected function isPageActive($url,$route)
	{
		if(isset($url) && is_array($url) && !strcasecmp(trim($url[0],'/'),$route))
		{
			unset($url['#']);
			if(count($url)>1)
			{
				foreach(array_splice($url,1) as $name=>$value)
				{
					if(!isset($_GET[$name]) || $_GET[$name]!=$value)
						return false;
				}
			}
			return true;
		}
		return false;
	}
}
