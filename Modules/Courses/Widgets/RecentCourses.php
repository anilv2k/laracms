<?php

namespace Modules\Courses\Widgets;

use Arrilot\Widgets\AbstractWidget;

class RecentCourses extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 5
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        
        //print_r($this->config);
        //echo "Anil Kumar Vinnakota and Swapnil and Abhiram & Akshaya";		
		  
        /*return view('widgets.recent_news', [
            'config' => $this->config,
        ]);*/
		
	   return view('courses::recentcourses');
    }
}
