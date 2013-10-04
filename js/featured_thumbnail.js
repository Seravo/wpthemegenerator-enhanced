function featured_thumb(){
	jQuery('ul.thumbnails').each(function(index, element) {
		var get_class=jQuery(this).attr('class');
		var get_parent=jQuery(this).closest('div');
		var wt=jQuery(this).closest('div').width();//width total
		var col=jQuery(this).attr('data-columns');//columns
		var dt=Math.floor(wt/col);
		var mt=6;
		var wa=dt-mt;
		var mg=3;
		var ft_size=jQuery(this).attr('data-ftsize');
		jQuery(this).css('font-size',ft_size+'px');
		get_parent.find('ul.thumbnails li').css({'max-width':wa+'px','margin':mg+'px','padding':'0'});
		get_parent.find('ul.thumbnails li h5').css({'font-size':ft_size+'px','font-weight':'bold','padding':'0 0 5px','margin':'0'});		
		get_parent.find('ul.thumbnails li img').css({'height':wa+'px','margin':'0'});        
		get_parent.find('ul.thumbnails li p').css({'margin':'0'});        		
    });
}
window.onload = featured_thumb;