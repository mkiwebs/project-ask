<?php
namespace app\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
/**
*  
*/
class SidebarWidget extends Widget
{
	public function init()
	{
		# code...
	}
	
	public function run()
	{
		//create a 3 level menu
        //dashboard menu
		    $data['menus'][] = array(
		    	'id'       => 'menu-dashboard',
		    	'icon'	   => 'fa-dashboard',
		    	'name'	   => "Dashboard",
		    	'href'     => Url::toRoute(['site/dashboard']),
                'children' => array()
            );

        //settings menu

		    $settings[]= array(
                'id'       => 'release-settings',
                'name'	   => "App Release",
                'href'     => Url::toRoute(['app-release/index']),
                'children' => array()
            );
            $settings[]= array(
                'id'       => 'recommend-settings',
                'name'	   => "Recommend",
                'href'     => Url::toRoute(['recommendation-details/index']),
                'children' => array()
            );
	        $settings[]= array(
	            'id'       => 'email-settings',
	            'name'	   => "Email",
	            'href'     => Url::toRoute(['settings/index']),
	            'children' => array()
	        );
		    $data['menus'][] = array(
		    	'id'       => 'menu-settings',
		    	'icon'	   => ' fa-wrench',
		    	'name'	   => "Settings",
		    	'href'     => '',
                'children' => $settings
		    );

		   //events menu
           //start jobs
            // $app_job[] = array(
            //     'id'       => 'add-job',
            //     'name'     => "Add Job",
            //     'href'     => Url::toRoute(['job/create']),
            //     'children' => array()
            //     );
            // $app_job[] = array(
            //     'id'       => 'list-job',
            //     'name'     => "Jobs",
            //     'href'     => Url::toRoute(['job/index']),
            //     'children' => array()
            //     );
            //  $app_job[] = array(
            //     'id'       => 'job-category',
            //     'name'     => "Add Job Category",
            //     'href'     => Url::toRoute(['job-category/create']),
            //     'children' => array()
            //     );
            //  $app_job[] = array(
            //     'id'       => 'job-category',
            //     'name'     => "Job Categories",
            //     'href'     => Url::toRoute(['job-category/index']),
            //     'children' => array()
            //     );
            //  $data['menus'][] = array(
            //             'id'       => 'menu-jobs',
            //             'icon'     => 'far fa-briefcase',
            //             'name'     => "Jobs",
            //             'href'     => '',
            //             'children' => $app_job
            //         );

            //     //end job
            //start business-list
             // $business_list[] = array(
             //     'id'       => 'add-business',
             //     'name'     => "Add Business",
             //     'href'     => Url::toRoute(['business-list/create']),
             //     'children' => array()
             //     );
             // $business_list[] = array(
             //     'id'       => 'list-business',
             //     'name'     => "Business List",
             //     'href'     => Url::toRoute(['business-list/index']),
             //     'children' => array()
             //     );
             //  $business_list[] = array(
             //     'id'       => 'business-category',
             //     'name'     => "Add Business Category",
             //     'href'     => Url::toRoute(['business-category/create']),
             //     'children' => array()
             //     );
             //  $business_list[] = array(
             //     'id'       => 'business-category',
             //     'name'     => "Business Categories",
             //     'href'     => Url::toRoute(['business-category/index']),
             //     'children' => array()
             //     );
             //  $data['menus'][] = array(
             //             'id'       => 'menu-jobs',
             //             'icon'     => 'far  fa-bank',
             //             'name'     => "Business Listing",
             //             'href'     => '',
             //             'children' => $business_list
             //         );

                 //end job

		    $app_event[]= array(
                'id'       => 'user-settings',
                'name'	   => "Add Event",
                'href'     => Url::toRoute(['app-event/create']),
                'children' => array()
            );
            $app_event[]= array(
                'id'       => 'general-settings',
                'name'	   => "Category",
                'href'     => Url::toRoute(['event-category/create']),
                'children' => array()
            );
	        $app_event[]= array(
	            'id'       => 'email-settings',
	            'name'	   => "Events",
	            'href'     => Url::toRoute(['app-event/index']),
	            'children' => array()
	        );
		    $data['menus'][] = array(
		    	'id'       => 'menu-settings',
		    	'icon'	   => 'far fa-calendar',
		    	'name'	   => "Events",
		    	'href'     => '',
                'children' => $app_event
		    );
        // file manager menu
		    $file_manager[]= array(
                'id'       => 'user-settings',
                'name'	   => "Manage",
                'href'     => Url::toRoute(['settings/index']),
                'children' => array()
            );
            $file_manager[]= array(
                'id'       => 'general-settings',
                'name'	   => "Upload",
                'href'     => Url::toRoute(['settings/index']),
                'children' => array()
            );
		    $data['menus'][] = array(
		    	'id'       => 'menu-settings',
		    	'icon'	   => ' fas fa-folder',
		    	'name'	   => "File Manager",
		    	'href'     => '',
                'children' => $file_manager
		    );

           //questions menu
		    $app_questions[]= array(
                'id'       => 'user-settings',
                'name'	   => "Add Questions",
                'href'     => Url::toRoute(['question/create']),
                'children' => array()
            );

            $app_questions[]= array(
                'id'       => 'questions-category',
                'name'     => " Question Category",
                'href'     => Url::toRoute(['question-category/index']),
                'children' => array()
            );
            $app_questions[]= array(
                'id'       => 'general-settings',
                'name'     => "Questions List",
                'href'     => Url::toRoute(['question/index']),
                'children' => array()
            );            
            $app_questions[]= array(
                'id'       => 'general-settings',
                'name'     => "Questions Answers",
                'href'     => Url::toRoute(['question-answer/index']),
                'children' => array()
            );            
            $app_questions[]= array(
                'name'	   => "Questions Follow",
                'href'     => Url::toRoute(['follow-question/index']),
                'children' => array()
            );
 
		    $data['menus'][] = array(
		    	'id'       => 'menu-settings',
		    	'icon'	   => ' fas fa-question-circle',
		    	'name'	   => "Questions",
		    	'href'     => '',
                'children' => $app_questions
		    );

		   //client side users menu 
		    $app_users[]= array(
                'id'       => 'user-settings',
                'name'	   => "Users",
                'href'     => Url::toRoute(['app-user/index']),
                'children' => array()
            );
            $app_users[]= array(
                'id'       => 'general-settings',
                'name'	   => "Profile",
                'href'     => Url::toRoute(['settings/index']),
                'children' => array()
            );
            $app_users[]= array(
                'id'       => 'user-roles',
                'name'	   => "User Roles",
                'href'     => Url::toRoute(['auth-item/index']),
                'children' => array()
            );
            $app_users[]= array(
                'id'       => 'assign-roles',
                'name'     => "Assign Role",
                'href'     => Url::toRoute(['auth-assignment/index']),
                'children' => array()
            );

            $app_users[]= array(
                'id'       => 'user-permissions',
                'name'     => "User Permission",
                'href'     => Url::toRoute(['auth-item-child/index']),
                'children' => array()
            );
              
            $app_users[]= array(
                'id'       => 'general-settings',
                'name'	   => "Questions List",
                'href'     => Url::toRoute(['settings/index']),
                'children' => array()
            );
		    $data['menus'][] = array(
		    	'id'       => 'menu-settings',
		    	'icon'	   => ' far fa-users',
		    	'name'	   => "Users",
		    	'href'     => '',
                'children' => $app_users
		    );

        // blog Articles menu
		    // $blog_articles[]= array(
      //           'id'       => 'user-settings',
      //           'name'	   => "List",
      //           'href'     => Url::toRoute(['article/index']),
      //           'children' => array()
      //       );
      //       $blog_articles[]= array(
      //           'id'       => 'general-settings',
      //           'name'	   => "Add Article",
      //           'href'     => Url::toRoute(['article/create']),
      //           'children' => array()
      //       );
      //       $blog_articles[]= array(
      //           'id'       => 'add-trending-news',
      //           'name'     => "Add Trending News",
      //           'href'     => Url::toRoute(['trending-news/create']),
      //           'children' => array()
      //       );
      //       $blog_articles[]= array(
      //           'id'       => 'general-settings',
      //           'name'     => "Trending News",
      //           'href'     => Url::toRoute(['trending-news/index']),
      //           'children' => array()
      //       );
		    // $data['menus'][] = array(
		    // 	'id'       => 'menu-settings',
		    // 	'icon'	   => 'fas fa-book',
		    // 	'name'	   => "Articles",
		    // 	'href'     => '',
      //           'children' => $blog_articles
		    // );

                    // memes menu
            $memes[]= array(
                'id'       => 'user-settings',
                'name'     => "Meme List",
                'href'     => Url::toRoute(['meme/index']),
                'children' => array()
            );
            $memes[]= array(
                'id'       => 'general-settings',
                'name'     => "Add Meme",
                'href'     => Url::toRoute(['meme/create']),
                'children' => array()
            );            
            $memes[]= array(
                'id'       => 'general-settings',
                'name'     => "Meme Likes",
                'href'     => Url::toRoute(['meme-like/index']),
                'children' => array()
            );
            $memes[]= array(
                'id'       => 'general-settings',
                'name'     => "Comment List",
                'href'     => Url::toRoute(['meme-comment/index']),
                'children' => array()
            );
            $data['menus'][] = array(
                'id'       => 'menu-settings',
                'icon'     => 'fas fa-book',
                'name'     => "Meme",
                'href'     => '',
                'children' => $memes
            );

            // IQ quiz
            $qtest[]= array(
                'id'       => 'user-settings',
                'name'     => "Quiz List",
                'href'     => Url::toRoute(['qtest/index']),
                'children' => array()
            );
            $qtest[]= array(
                'id'       => 'general-settings',
                'name'     => "Add Quiz",
                'href'     => Url::toRoute(['qtest/create']),
                'children' => array()
            );
            $qtest[]= array(
                'id'       => 'general-settings',
                'name'     => "Comment List",
                'href'     => Url::toRoute(['qcomment/index']),
                'children' => array()
            );
            $data['menus'][] = array(
                'id'       => 'menu-settings',
                'icon'     => 'fas fa-book',
                'name'     => "IQ Questions",
                'href'     => '',
                'children' => $qtest
            );
        // blog categories menu
		    // $blog_categories[]= array(
      //           'id'       => 'user-settings',
      //           'name'	   => "List",
      //           'href'     => Url::toRoute(['category/index']),
      //           'children' => array()
      //       );
      //       $blog_categories[]= array(
      //           'id'       => 'general-settings',
      //           'name'	   => "Add Category",
      //           'href'     => Url::toRoute(['category/create']),
      //           'children' => array()
      //       );
		    // $data['menus'][] = array(
		    // 	'id'       => 'menu-settings',
		    // 	'icon'	   => 'fas fa-book',
		    // 	'name'	   => "Blog Categories",
		    // 	'href'     => '',
      //           'children' => $blog_categories
		    // );
		      
            //blog tags menu
		    // $blog_tags[]= array(
      //           'id'       => 'user-settings',
      //           'name'	   => "List",
      //           'href'     => Url::toRoute(['tag/index']),
      //           'children' => array()
      //       );
      //       $blog_tags[]= array(
      //           'id'       => 'general-settings',
      //           'name'	   => "Add Tags",
      //           'href'     => Url::toRoute(['tag/create']),
      //           'children' => array()
      //       );
		    // $data['menus'][] = array(
		    // 	'id'       => 'menu-settings',
		    // 	'icon'	   => ' fa-wrench',
		    // 	'name'	   => "Blog Tags",
		    // 	'href'     => '',
      //           'children' => $blog_tags
		    // );
		//app statistics menu
		    $app_statistics[]= array(
                'id'       => 'user-requests',
                'name'	   => "User Requests",
                'href'     => Url::toRoute(['user-request/index']),
                'children' => array()
            );
            $app_statistics[]= array(
                'id'       => 'blog-likes',
                'name'	   => "Blog Likes",
                'href'     => Url::toRoute(['app-likes/index']),
                'children' => array()
            );
            $app_statistics[]= array(
                'id'       => 'app-logs',
                'name'	   => "Logs",
                'href'     => Url::toRoute(['app-log/index']),
                'children' => array()
            );
            $app_statistics[]= array(
                'id'       => 'app-feedback',
                'name'     => "Feedback",
                'href'     => Url::toRoute(['feedback/index']),
                'children' => array()
            );
            $app_statistics[]= array(
                'id'       => 'general-settings',
                'name'     => "Users",
                'href'     => Url::toRoute(['statistics/users']),
                'children' => array()
            );
		    $data['menus'][] = array(
		    	'id'       => 'menu-settings',
		    	'icon'	   => 'fa-line-chart',
		    	'name'	   => "Statistics",
		    	'href'     => '',
                'children' => $app_statistics
		    );


		    //end custom
	   return $this->render('sidebar', [
            'menus' => $data,
        ]);
	}
}
?>