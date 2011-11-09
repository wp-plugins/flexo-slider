<?php
/*
Plugin Name: flexoslider
Contributors: flexostudio
Tags:gallery, slider, pics, images
Author: flexostudio
Description:
Version: 1.0006 
Stable tag:1.0006
Requires at least:3.0.5
Tested up to: 3.0.5
*/


class flexoslider {
	
/* =spisyk s snimki ot izbranata galeriq
-------------------------------------------------------------------*/
	
public static	function nggGetSliderPics($chosen_gallery) {

	global $wpdb;
	//	echo "<pre>";print_r ($chosen_gallery);echo "</pre>";
		
		$query = "SELECT * FROM " . $wpdb->prefix . "ngg_pictures WHERE galleryid = " . $chosen_gallery['GalleryID'];
		$results = $wpdb->get_results($query);
			//echo "<pre>";print_r ($results);echo "</pre>";
		$query = "SELECT path FROM " . $wpdb->prefix . "ngg_gallery WHERE gid = " . $chosen_gallery['GalleryID'];
		$dirresult = $wpdb->get_results($query);

			$sliderPicsHTML = '';
			
				for ($i = 0; $i < $chosen_gallery ['max_br']; $i++ ) {
						$new_rezult[$i] = $results[$i];
				}
			
			if($chosen_gallery['order'] == 'random') {
				for ($i = 0; $i < $chosen_gallery ['max_br']; $i++ ) {
					$rand=floor(rand($i, $chosen_gallery ['max_br']-1));
					$temp=$new_rezult[$i];
	    		$new_rezult[$i]=$new_rezult[$rand];
	    		$new_rezult[$rand]=$temp;
				}
			}
			else {
				$new_rezult = $results;
			}
				
				
			/*  proverka true/false za title  i link*/
			
				if($chosen_gallery['img_title']=='true'):
								if($chosen_gallery ['img_link']=='true') {
									
									foreach ($new_rezult as $new_rezult) {
									$sliderPicsHTML .= '<a href="' . $new_rezult->description . '"><img src="/' . $dirresult[0]->path . '/' . $new_rezult->filename . '" alt="' . $new_rezult->alttext . '" title="' . $new_rezult->alttext . '"></a>';
									}	
								}
								else {
									foreach ($new_rezult as $new_rezult) {
									$sliderPicsHTML .= '<img src="/' . $dirresult[0]->path . '/' . $new_rezult->filename . '" alt="' . $new_rezult->alttext . '" title="' . $new_rezult->alttext . '">';
									}
								}
					
						
				else: 		
				
								if($chosen_gallery ['img_link']=='true') {
									
									foreach ($new_rezult as $new_rezult) {
									$sliderPicsHTML .= '<a href="' . $new_rezult->description . '"><img src="/' . $dirresult[0]->path . '/' . $new_rezult->filename . '" alt="' . $new_rezult->alttext . '" ></a>';
									}	
								}
								else {
									foreach ($new_rezult as $new_rezult) {
									$sliderPicsHTML .= '<img src="/' . $dirresult[0]->path . '/' . $new_rezult->filename . '" alt="' . $new_rezult->alttext . '">';
									}
								}
			
				endif;
		return $sliderPicsHTML;

}

/* =vry6ta gotoviq slider
-----------------------------------------------------*/

public static function get_gallery ($_params) {
	global $flexoslider_html_gallery;
	$pic_array=$flexoslider_html_gallery;

	$gallery_ret='<div class="nivoSlider" id="slider" style="height:'.$_params['height'].'px; width:'.$_params['width'].'px;">
		'. $pic_array.'</div>';
		$gallery_ret .= self::gen_nivo_script($_params);
	return $gallery_ret;
}

/* =izkarva slidera
----------------------------------------------------*/

public static function show_gallery($id=1) {

	/*$pic_array=nggGetSliderPics($id);
	?>
	<div class="nivoSlider" id="slider" style="height:<?php echo $height; ?>; width:<?php echo $width; ?>;">
		<?php echo $pic_array;?>
	</div>
	<?php */
	
	global $flexoslider_html_gallery;
	$flexoslider_html_gallery = flexoslider::nggGetSliderPics($id);
	echo flexoslider::get_gallery();
}

/* =dobavq slidera na izbranoto mqsto 
-------------------------------------------------------------------------*/

public static function filter($content) {
	global $flexoslider_html_gallery;
	$ret 			=	"";
	$pattern	=	"[flexoslider ";
	
	$spos 		=	0;
	$epos			=	-1;
	//echo $content;
	while(($spos = strpos($content,$pattern,++$epos)) > -1):
		$last			=	$epos;
		$epos			=	strpos($content,"]",$spos);
		if($epos != -1):
			//$ret	 .= 
			$offset		=	strpos($content," ",$spos);
			$settings	=	substr($content,$offset,$epos - $offset);

			$ret   .= substr($content,$last,$spos-$last);
			if(preg_match_all('/(?<key>[^=]+)=[\'"](?<val>[^\'"]+)[\'"]/i',$settings,$m)):
				$params		=	array();	
				echo $ret;
				
			
				foreach($m['key'] as $key => $val):
					$_key	=	trim($m['key'][$key]);
					$params[$_key] = trim($m['val'][$key]);
				endforeach;

		$flexoslider_html_gallery = flexoslider::nggGetSliderPics($params);
		//echo "<pre>";print_r ($params); echo "</pre>";
		$ret .= flexoslider::get_gallery($params);
			//	echo "<pre>";print_r ($ret); echo "</pre>";
			endif;
		endif;
	endwhile;
		$ret .= substr($content,$epos);//echo $ret;
	return $ret;
}





/* =admin panel FlexoSlider
----------------------------------------------------------------*/
public static function flexo_slider_option() {
	?>
			<style>
				#flexo_slider_page input[type="text"]{
					margin-top:10px;
					margin-bottom:10px;
					margin-left:35px;
				}
				#flexo_slider_page input[type="radio"]{
					margin-bottom:10px;
					
				}
			</style>
<?php
						if ($_POST['gen_change']){
							$gen = stripslashes($_POST['code_change']);
							//echo $gen; 
																		$ret 			=	"";
																		$pattern	=	"[flexoslider ";
																		
																		$spos 		=	0;
																		$epos			=	-1;
																		//echo $content;
																		while(($spos = strpos($gen,$pattern,++$epos)) > -1):
																			$last			=	$epos;
																			$epos			=	strpos($gen,"]",$spos);
																			if($epos != -1):
																				//$ret	 .= 
																				$offset		=	strpos($gen," ",$spos);
																				$settings	=	substr($gen,$offset,$epos - $offset);
																	
																				$ret   .= substr($gen,$last,$spos-$last);
																				if(preg_match_all('/(?<key>[^=]+)=[\'"](?<val>[^\'"]+)[\'"]/i',$settings,$m)):
																					$params		=	array();	
																					echo $ret;
																					
																				
																					foreach($m['key'] as $key => $val):
																						$_key	=	trim($m['key'][$key]);
																						$params[$_key] = trim($m['val'][$key]);
																					endforeach;
																					endif;
																			endif;
																		endwhile;
							//echo'<pre>';print_r($params);echo'</pre>';
							$GalleryID = $params['GalleryID'];
							$effect = $params['effect'];
							$animSpeed = $params['animSpeed'];
							$pauseTime = $params['pauseTime'];
							$width = $params['width'];
							$height = $params['height'];
							$img_link = $params['img_link'];
							$img_title = $params['img_title'];
							$img_nav = $params['img_nav'];
							$max_br = $params['max_br'];
							$order = $params['order'];
							$pause = $_POST['pause'];
							$nav_arrow = $_POST['nav_arrow'];
						
						}
						elseif ($_POST['submit']){
							$GalleryID = $_POST['GalleryID'];
							$effect = $_POST['effect'];
							$animSpeed = $_POST['animSpeed'];
							$pauseTime = $_POST['pauseTime'];
							$width = $_POST['width'];
							$height = $_POST['height'];
							$img_link = $_POST['img_link'];
							$img_title = $_POST['img_title'];
							$img_nav = $_POST['img_nav'];
							$max_br = $_POST['max_br'];
							$order = $_POST['order'];
							$pause = $_POST['pause'];
							$nav_arrow = $_POST['nav_arrow'];
						}
?>
	<div id="flexo_slider_page">
			<form method="POST">
				
				</br>ID на галерията<input style="width: 100px;" type="text" name="GalleryID" value="<?php echo $GalleryID; ?>" />
				
				</br>Ефект:
				<table>
								<tr>
									<td><input  type="radio" name="effect" value="sliceDown"  <?php echo $effect == 'sliceDown' ? 'checked' : ''; ?> /> sliceDown</td>
									 <td><input  type="radio" name="effect" value="sliceDownLeft" <?php echo $effect == 'sliceDownLeft' ? 'checked' : ''; ?> /> sliceDownLeft</td>
									 <td><input  type="radio" name="effect" value="sliceUp" <?php echo $effect == 'sliceUp' ? 'checked' : ''; ?> /> sliceUp</td>
									 <td><input  type="radio" name="effect" value="sliceUpLeft" <?php echo $effect == 'sliceUpLeft' ? 'checked' : ''; ?> /> sliceUpLeft</td>
									 <td><input  type="radio" name="effect" value="sliceUpDownLeft" <?php echo $effect == 'sliceUpDownLeft' ? 'checked' : ''; ?> /> sliceUpDownLeft</td>
								</tr>
								<tr>
									 <td><input  type="radio" name="effect" value="fold" <?php echo $effect == 'fold' ? 'checked' : ''; ?> /> fold</td>
									 <td><input  type="radio" name="effect" value="fade" <?php echo $effect == 'fade' ? 'checked' : ''; ?> /> fade</td>
									 <td><input  type="radio" name="effect" value="random" checked <?php echo $effect == 'random' ? 'checked' : ''; ?> /> random</td>
									 <td><input  type="radio" name="effect" value="slideInRight" <?php echo $effect == 'slideInRight' ? 'checked' : ''; ?> /> slideInRight</td>
									 <td><input  type="radio" name="effect" value="slideInLeft" <?php echo $effect == 'slideInLeft' ? 'checked' : ''; ?> /> slideInLeft</td>
								</tr>
								<tr>
									 <td><input  type="radio" name="effect" value="boxRandom" <?php echo $effect == 'boxRandom' ? 'checked' : ''; ?> /> boxRandom</td>
									 <td><input  type="radio" name="effect" value="boxRain" <?php echo $effect == 'boxRain' ? 'checked' : ''; ?> /> boxRain</td>
									 <td><input  type="radio" name="effect" value="boxRainReverse" <?php echo $effect == 'boxRainReverse' ? 'checked' : ''; ?> /> boxRainReverse</td>
					 				 <td><input  type="radio" name="effect" value="boxRainGrow" <?php echo $effect == 'boxRainGrow' ? 'checked' : ''; ?> /> boxRainGrow</td>
					 				 <td><input  type="radio" name="effect" value="boxRainGrowReverse" <?php echo $effect == 'boxRainGrowReverse' ? 'checked' : ''; ?> /> boxRainGrowReverse</td>
					 			</tr>	
					</table>
				</br>Скорост на анимиране в ms</br>/време за изпълнение на ефекта/<input style="width: 100px;" type="text" name="animSpeed" value="<?php echo $animSpeed; ?>"/>
				
				</br>Време на пауза в ms</br>/интервал за стартиране на ефекта/<input style="width: 100px;" type="text" name="pauseTime" value="<?php echo $pauseTime; ?>"/>
				
			</br>! 1сек. = 1000ms
				</br>Ширина<input style="width: 100px;" type="text" name="width" value="<?php echo $width; ?>"/>
				
				</br>Височина<input style="width: 100px;" type="text" name="height" value="<?php echo $height; ?>"/>
				
				</br>Link на снимката	<input  type="radio" name="img_link" value="true" checked <?php echo $img_link == 'true' ? 'checked' : ''; ?> /> yes
									 						<input  type="radio" name="img_link" value="false"<?php echo $img_link == 'false' ? 'checked' : ''; ?>/> no
									 						
				</br>Покажи име на снимката	<input  type="radio" name="img_title" value="true" checked <?php echo $img_title == 'true' ? 'checked' : ''; ?> /> yes
									 									<input  type="radio" name="img_title" value="false" <?php echo $img_title == 'false' ? 'checked' : ''; ?>/> no
									 									
				</br>Покажи навигация	<input  type="radio" name="img_nav" value="true" checked <?php echo $img_nav == 'true' ? 'checked' : ''; ?> /> yes
									 						<input  type="radio" name="img_nav" value="false" <?php echo $img_nav == 'false' ? 'checked' : ''; ?>/> no
									 						
				</br>Брой изображения	<input  type="text" name="max_br" value="<?php echo $max_br; ?>"  /> 
				
				</br>Подредба на изображения <input  type="radio" name="order" value="order" checked <?php echo $order == 'order' ? 'checked' : ''; ?> /> order
									 									 <input  type="radio" name="order" value="random" <?php echo $order == 'random' ? 'checked' : ''; ?>/> random
									 						
				</br>Пауза при мишка в/у симката <input  type="radio" name="pause" value="true" checked <?php echo $pause == 'true' ? 'checked' : ''; ?> /> yes
									 									 		 <input  type="radio" name="pause" value="false" <?php echo $pause == 'false' ? 'checked' : ''; ?>/> no
									 					
				</br>Стрелки предишна & следваща снимка<input  type="radio" name="nav_arrow" value="true" checked <?php echo $nav_arrow == 'true' ? 'checked' : ''; ?> /> yes
									 									 		 				<input  type="radio" name="nav_arrow" value="false" <?php echo $nav_arrow == 'false' ? 'checked' : ''; ?>/> no
									 					
								 					
									 						
				</br></br><input type="submit" name="submit" value="Generating"></br>
				
	
						
		</div>

	</br>Generating code<input  type="text" style=" width:900px;" name="gen_text" value= " <?php
			echo "[flexoslider ";
			echo " GalleryID='".$GalleryID."' ";
			echo "effect='";
			echo $effect."' ";
			if ($animSpeed):
				echo "animSpeed='".$animSpeed."' ";
				endif;
			if ($pauseTime):
				echo "pauseTime='".$pauseTime."' ";
				endif;
			if ($width):
				echo "width='".$width."' ";
				endif;
			if ($height):
				echo "height='".$height."' ";
				endif;
			echo "img_link ='".$img_link."' " ;
			echo "img_title ='".$img_title."' " ;
			echo "img_nav ='".$img_nav."' " ;
			echo "max_br ='".$max_br."' " ;
			echo "order ='".$order."' " ;
			echo "pause ='".$pause."' " ;
			echo "nav_arrow ='".$nav_arrow."' " ;
			echo "]";?>" />
			
			</br></br>Code to chande<input type="text" style=" width:900px;" name="code_change" value="<?php echo $gen; ?>"/>
															<input type="submit" name="gen_change" value="Change">
			
			
		</form>
	
<?php		
		
	
	
	

}
	public static function flexo_slider_menu () {
		add_options_page('admin slider','slider option','manage_options','slider-manager','flexoslider::flexo_slider_option','');
	}

	/* =Nivo Slider Light Init
	----------------------------------------------------------------*/
	public static function nivo_init() {
		$url = plugins_url( 'nsl' , __FILE__ );
		wp_enqueue_script('nivoSliderScript', $url.'/jquery.nivo.slider.pack.js', array('jquery'));
		wp_enqueue_style('nivoStyleSheet', $url.'/nivo-slider.css');
		wp_enqueue_style('nivoCustomStyleSheet', $url.'/custom-nivo-slider.css');
	}
	
		function gen_nivo_script($_params) {
			return '
		<script type="text/javascript">
		/* <![CDATA[ */
			jQuery(document).ready(function($){
				$(".nivoSlider br").each(function(){ // strip BR elements created by Wordpress
					$(this).remove();
				});
				$(".nivoSlider").nivoSlider({
					effect:"'.$_params['effect'].'", //Specify sets like: "random,fold,fade,sliceDown"
					// All effects:
					// sliceDown, sliceDownLeft, sliceUp, sliceUpLeft, sliceUpDown
					// sliceUpDownLeft, fold, fade, random, slideInRight,
					// slideInLeft, boxRandom, boxRain, boxRainReverse, boxRainGrow
					// boxRainGrowReverse
					animSpeed:'.$_params['animSpeed'].', //Slide transition speed
					pauseTime:'.$_params['pauseTime'].',
					startSlide:0, //Set starting Slide (0 index)
					directionNav:'.$_params['nav_arrow'].', //Next & Prev
					directionNavHide:true, //Only show on hover
					controlNav:'.$_params['img_nav'].', //1,2,3...
					controlNavThumbs:false, //Use thumbnails for Control Nav
					controlNavThumbsFromRel:false, //Use image rel for thumbs
					controlNavThumbsSearch: ".jpg", //Replace this with...
					controlNavThumbsReplace: "_thumb.jpg", //...this in thumb Image src
					keyboardNav:true, //Use left & right arrows
					pauseOnHover:'.$_params['pause'].', //Stop animation while hovering
					manualAdvance:false, //Force manual transitions
					captionOpacity:0.8, //Universal caption opacity
					beforeChange: function(){},
					afterChange: function(){},
					slideshowEnd: function(){} //Triggers after all slides have been shown
				});
			});
		/* ]]> */
		</script>';
		}	

}







if(function_exists('add_action')):
	if (!is_admin()  ) {
		add_action('init', 'flexoslider::nivo_init');
		//add_action('wp_head', 'NivoHeader');
		add_filter('the_content','flexoslider::filter');
	}else{
		add_action('admin_menu', 'flexoslider::flexo_slider_menu');
	}
endif; 
?>