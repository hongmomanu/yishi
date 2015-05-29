<?php $this->_compileInclude('header'); ?><body><?php $this->_compileInclude('nav'); ?><div class="container-fluid">	<div class="row-fluid">		<div class="span2">			<?php $this->_compileInclude('menu'); ?>		</div>		<div class="span10">			<ul class="breadcrumb">				<li><a href="index.php?core-master">全局</a> <span class="divider">/</span></li>				<li><a href="index.php?core-master-apps">模块管理</a> <span class="divider">/</span></li>				<li class="active">模块设置</li>			</ul>			<form action="index.php?core-master-apps-config" method="post" class="form-horizontal">				<fieldset>				<legend><?php if($this->tpl_var['app']['appname']){ ?><?php echo $this->tpl_var['app']['appname']; ?><?php } else { ?><?php echo $this->tpl_var['appid']; ?><?php } ?></legend>				<div class="control-group">					<label for="appname" class="control-label">模块名称：</label>					<div class="controls">						<input id="appname" name="args[appname]" type="text" value="<?php echo $this->tpl_var['app']['appname']; ?>" needle="needle" msg="您必须输入模块名称" />					</div>				</div>				<div class="control-group">					<label class="control-label">模块状态：</label>					<div class="controls">						<label class="radio inline">							<input name="args[appstatus]" type="radio" value="1" <?php if($this->tpl_var['app']['appstatus']){ ?>checked<?php } ?>/>开启						</label>						<label class="radio inline">							<input name="args[appstatus]" type="radio" value="0" <?php if(!$this->tpl_var['app']['appstatus']){ ?>checked<?php } ?>/>禁用						</label>					</div>				</div>				<div class="control-group">					<label class="control-label">模块缩略图：</label>					<div class="controls">						<div class="thumbuper pull-left">							<div class="thumbnail">								<a href="javascript:;" class="second label""><em class="uploadbutton" id="appthumb" exectype="thumb"></em></a>								<div class="first" id="appthumb_percent"></div>								<div class="boot"><img src="app/core/styles/images/noimage.gif" id="appthumb_view"/><input type="hidden" name="args[appthumb]" value="" id="appthumb_value"/></div>							</div>						</div>					</div>				</div>				<div class="control-group">					<label for="seo_title" class="control-label">SEO Title：</label>					<div class="controls">						<input id="seo_title" name="args[appsetting][seo][title]" type="text" value="<?php echo $this->tpl_var['app']['appsetting']['seo']['title']; ?>"/>					</div>				</div>				<div class="control-group">					<label for="seo_keywords" class="control-label">SEO Keywords：</label>					<div class="controls">						<input id="seo_keywords" name="args[appsetting][seo][keywords]" type="text" value="<?php echo $this->tpl_var['app']['appsetting']['seo']['keywords']; ?>"/>					</div>				</div>				<div class="control-group">					<label for="seo_description" class="control-label">SEO Description：</label>					<div class="controls">						<textarea id="seo_description" name="args[appsetting][seo][description]" class="input-xxlarge"><?php echo $this->tpl_var['app']['appsetting']['seo']['description']; ?></textarea>					</div>				</div>				<div class="control-group">					<div class="controls">						<button class="btn btn-primary" type="submit">提交</button>						<input type="hidden" name="page" value="<?php echo $this->tpl_var['page']; ?>"/>						<input type="hidden" name="appconfig" value="1"/>						<input type="hidden" name="appid" value="<?php echo $this->tpl_var['appid']; ?>"/>						<?php $aid = 0;
 foreach($this->tpl_var['search'] as $key => $arg){ 
 $aid++; ?>						<input type="hidden" name="search[<?php echo $key; ?>]" value="<?php echo $arg; ?>"/>						<?php } ?>					</div>				</div>				</fieldset>			</form>		</div>	</div></div></body></html>