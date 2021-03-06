<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Inherit from another theme
	|--------------------------------------------------------------------------
	|
	| Set up inherit from another if the file is not exists, this 
	| is work with "layouts", "partials", "views" and "widgets"
	|
	| [Notice] assets cannot inherit.
	|
	*/

	'inherit' => null, //default

	/*
	|--------------------------------------------------------------------------
	| Listener from events
	|--------------------------------------------------------------------------
	|
	| You can hook a theme when event fired on activities this is cool 
	| feature to set up a title, meta, default styles and scripts.
	|
	| [Notice] these event can be override by package config.
	|
	*/

	'events' => array(

		'before' => function($theme)
		{
			$theme->setTitle('Title example');
			$theme->setAuthor('Jonh Doe');
			$theme->set('name','Abhi ram');
			
			$settings= Modules\Cms\Entities\Setting::all();
			
			foreach ($settings as $setting) {
			
			$theme->set($setting->name,$setting->value);
			
			}

			
		},

		'asset' => function($asset)
		{
			// Preparing asset you need to serve later for a specific view.
			$asset->cook('datatables', function($asset)
			{
				//load these assets when you need js by calling : $this->theme->asset()->serve('datatables');
				$asset->themePath()->add('datatables', 'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css');
				$asset->themePath()->add('datables-js', 'plugins/datatables/jquery.dataTables.min.js');
				$asset->themePath()->add('datables-js-2', 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');
				$asset->themePath()->add('datables-responsive-css', 'plugins/datatables-responsive/css/responsive.bootstrap4.min.css');
				$asset->themePath()->add('datables-responsive-js', 'plugins/datatables-responsive/js/dataTables.responsive.min.js');
				$asset->themePath()->add('datables-responsive-js-2', 'plugins/datatables-responsive/js/responsive.bootstrap4.min.js');				
			});
			
  
			
			$asset->cook('calendar', function($asset)
			{
				$asset->themePath()->add('fullcalendar', 'plugins/fullcalendar/main.min.css');
				$asset->themePath()->add('fullcalendar-daygrid', 'plugins/fullcalendar-daygrid/main.min.css');
				$asset->themePath()->add('fullcalendar-timegrid', 'plugins/fullcalendar-timegrid/main.min.css');	
                $asset->themePath()->add('fullcalendar-bootstrap', 'plugins/fullcalendar-bootstrap/main.min.css');

				$asset->themePath()->add('fullcalendar-js', 'plugins/fullcalendar/main.min.js');	
				$asset->themePath()->add('fullcalendar-daygrid-js', 'plugins/fullcalendar-daygrid/main.min.js');
				$asset->themePath()->add('fullcalendar-timegrid-js', 'plugins/fullcalendar-timegrid/main.min.js');	
				$asset->themePath()->add('fullcalendar-interaction-js', 'plugins/fullcalendar-interaction/main.min.js');	
				$asset->themePath()->add('fullcalendar-bootstrap-js', 'plugins/fullcalendar-bootstrap/main.min.js');	
				
				
			});
			
			
			
			$asset->add('core-font', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700.css');
			$asset->add('core-style1', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css');
			$asset->themePath()->add([
										[
											'styles', 
											[
												'plugins/fontawesome-free/css/all.min.css',
												'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
												'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
												'css/adminlte.css',
												'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
												'plugins/daterangepicker/daterangepicker.css',
												'plugins/summernote/summernote-bs4.css',
												'plugins/toastr/toastr.min.css'
											]
										],
										[
											'scripts', 
											[
												'plugins/jquery/jquery.min.js',
												'plugins/jquery-ui/jquery-ui.min.js',
												'plugins/bootstrap/js/bootstrap.bundle.min.js',
												'plugins/chart.js/Chart.min.js',
												'plugins/sparklines/sparkline.js',
												'plugins/jquery-knob/jquery.knob.min.js',
												'plugins/moment/moment.min.js',
												'plugins/daterangepicker/daterangepicker.js',
												'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
												'plugins/summernote/summernote-bs4.min.js',
												'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
												'js/adminlte.js',
												'js/pages/dashboard.js',
												'js/demo.js',
												'plugins/toastr/toastr.min.js',
												//'js',
											]
										]
									 ]);

			// You may use elixir to concat styles and scripts.
			/*
			$asset->themePath()->add([
										['styles', 'dist/css/styles.css'],
										['scripts', 'dist/js/scripts.js']
									 ]);
			*/

			// Or you may use this event to set up your assets.
			/*
			$asset->themePath()->add('core', 'core.js');			
			$asset->add([
							['jquery', 'vendor/jquery/jquery.min.js'],
							['jquery-ui', 'vendor/jqueryui/jquery-ui.min.js', ['jquery']]
						]);
			*/
		},


		'beforeRenderTheme' => function($theme)
		{
			// To render partial composer
			/*
	        $theme->partialComposer('header', function($view){
	            $view->with('auth', Auth::user());
	        });
			*/

		},

		'beforeRenderLayout' => array(

			'mobile' => function($theme)
			{
				// $theme->asset()->themePath()->add('ipad', 'css/layouts/ipad.css');
			}

		)

	)

);