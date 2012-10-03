CheckSpecificPage Yii Behaviour
================================

General
--------

This extension is a simple behavior component that is attached to your 'web application' to check whether the current page is the specified page or not. Its a very simple and short yet important stuff in anyone's project. Usually we want to filter some portion in our view page or take coding decisions according to the page displayed, which you could do easily using this. This extension is basically inspired from [pisfrontpage](http://www.yiiframework.com/extension/pisfrontpage/ "pisfrontpage") extension.



Requirements


------------

Yii 1.0 or above

Installation
------------

1. Extract the contents of this package. 
2. Put the resulted php class file under /protected/components

3. Inside protected/config/main.php config file:
 


<?php
// ...

'behaviors' => array(
    
	'isFrontPageTeller' => array(
        
		'class' => 'application.components.PageChecker',
    
	)
),

// ...
?>

Usage
-----
Where you want to check for the specific page rendered, place following code and pass either the following predefined strings:
	-`homepage` for Hompage/frontpage, 
	-`contact` for Contact Page, 
	-`about` for About Us page and 
	-`login` for Login page
or the controller action route itself.

<?php 
if (Yii::app()->checkSpecifiedPage('<pagename or controller route>')) {
  // do something specific for the page
}
?>

For example to check whether the rendered page is the homepage or frontpage then check with the following code:

<?php 
if (Yii::app()->checkSpecifiedPage('homepage')) {
  // do something specific for the homepage
}
?>

Likewise for contact page, you could use

<?php 
if (Yii::app()->checkSpecifiedPage('contact')) {
  // do something specific for the homepage
}
?>

OR you could pass the controller action route
<?php 
if (Yii::app()->checkSpecifiedPage('exampleController/exampleAction')) {
  // do something specific for the exampleAction page in the exampleController 	Controller
}
?>

Project Page
------------

https://github.com/sharkgr8/PageChecker

TODOs and BUGS
--------------

See: https://github.com/sharkgr8/PageChecker/issues
