<!-- Next Post Addon-->
<ul>
	<li class="next-post">
		<a href="#">
			<span><?php echo $this->lang->line('lang_btn_next_post'); ?></span>
			<strong><?php if(isset($nextPost[0]['title'])) echo $nextPost[0]['title'];  ?></strong>
		</a>
	</li>

	<li class="prev-post">
		<a href="#">
			<span><?php echo $this->lang->line('lang_btn_prev_post'); ?></span>
			<strong><?php if(isset($prevPost[0]['title'])) echo $prevPost[0]['title'];  ?></strong>
		</a>
	</li>

	<input type="hidden" name="current_id" id="current_id" value="<?php if(isset($prevPost[0]['id'])) echo $prevPost[0]['id'];  ?>">
</ul>
<!-- / Next Post Addon-->