<?php if(!$this->tpl_var['userhash']){ ?>
<?php $this->_compileInclude('header'); ?>
<body>
<?php $this->_compileInclude('nav'); ?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
			<?php $this->_compileInclude('menu'); ?>
		</div>
		<div class="span10" id="datacontent">
<?php } ?>
			<ul class="breadcrumb">
				<li><a href="index.php?<?php echo $this->tpl_var['_app']; ?>-teach"><?php echo $this->tpl_var['apps'][$this->tpl_var['_app']]['appname']; ?></a> <span class="divider">/</span></li>
				<li><a href="index.php?<?php echo $this->tpl_var['_app']; ?>-teach-exams&page=<?php echo $this->tpl_var['page']; ?><?php echo $this->tpl_var['u']; ?>">试卷管理</a> <span class="divider">/</span></li>
				<li class="active">随机组卷</li>
			</ul>
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#">随机组卷</a>
				</li>
				<li class="pull-right">
					<a href="index.php?<?php echo $this->tpl_var['_app']; ?>-teach-exams&page=<?php echo $this->tpl_var['page']; ?><?php echo $this->tpl_var['u']; ?>">试卷管理</a>
				</li>
			</ul>
	        <form action="?exam-teach-exams-autopage" method="post" class="form-horizontal">
				<div class="control-group">
					<label class="control-label" for="content">试卷名称：</label>
			  		<div class="controls">
			  			<input type="text" name="args[exam]" value="" needle="needle" msg="您必须为该试卷输入一个名称"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="content">考试科目：</label>
				  	<div class="controls">
					  	<select class="combox" needle="needle" min="1" name="args[examsubject]" onchange="javascript:$('#examrulesbox').loadUrl('index.php?exam-teach-exams-ajax&subjectid='+$(this).find('option:selected').val());">
						  	<?php $sid = 0;
 foreach($this->tpl_var['subjects'] as $key => $subject){ 
 $sid++; ?>
						  	<option value="<?php echo $subject['subjectid']; ?>"><?php echo $subject['subject']; ?></option>
						  	<?php } ?>
					  	</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="content">考试时间：</label>
			  		<div class="controls">
			  			<input type="text" name="args[examsetting][examtime]" value="60" size="4" needle="needle" class="inline"/> 分钟
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="content">来源：</label>
			  		<div class="controls">
			  			<input type="text" name="args[examsetting][comfrom]" value="" size="4"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="content">试卷总分：</label>
			  		<div class="controls">
			  			<input type="text" name="args[examsetting][score]" value="" size="4" needle="needle" msg="你要为本考卷设置总分" datatype="number"/>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="content">及格线：</label>
			  		<div class="controls">
			  			<input type="text" name="args[examsetting][passscore]" value="" size="4" needle="needle" msg="你要为本考卷设置一个及格分数线" datatype="number"/>
					</div>
				</div>
				<?php $qid = 0;
 foreach($this->tpl_var['questypes'] as $key => $questype){ 
 $qid++; ?>
				<div class="control-group">
					<label class="control-label" for="content"><?php echo $questype['questype']; ?>：</label>
					<div class="controls">
						<span class="info">共&nbsp;</span>
						<input id="iselectallnumber_<?php echo $questype['questid']; ?>" type="text" class="input-mini" needle="needle" name="args[examsetting][questype][<?php echo $questype['questid']; ?>][number]" value="" size="2" msg="您必须填写总题数"/>
						<span class="info">&nbsp;题，每题&nbsp;</span><input class="input-mini" needle="needle" type="text" name="args[examsetting][questype][<?php echo $questype['questid']; ?>][score]" value="" size="2" msg="您必须填写每题的分值"/>
						<span class="info">&nbsp;分，描述&nbsp;</span><input class="input-mini" type="text" name="args[examsetting][questype][<?php echo $questype['questid']; ?>][describe]" value="" size="12"/>
						<span class="info">&nbsp;难度题数：易&nbsp;</span><input class="input-mini" type="text" name="args[examsetting][questype][<?php echo $questype['questid']; ?>][easynumber]" value="0" size="2" msg="您需要填写简单题的数量，最小为0"/>
  						<span class="info">&nbsp;中&nbsp;</span><input class="input-mini" type="text" needle="needle" name="args[examsetting][questype][<?php echo $questype['questid']; ?>][middlenumber]" value="0" size="2" msg="您需要填写中等难度题的数量，最小为0"/>
  						<span class="info">&nbsp;难&nbsp;</span><input class="input-mini" type="text" needle="needle" name="args[examsetting][questype][<?php echo $questype['questid']; ?>][hardnumber]" value="0" size="2" datatype="number" msg="您需要填写难题的数量，最小为0"/>
					</div>
				</div>
				<?php } ?>
				<div class="control-group">
					<div class="controls">
						<button class="btn btn-primary" type="submit">提交</button>
						<input type="hidden" name="submitsetting" value="1"/>
					</div>
				</div>
			</form>
<?php if(!$this->tpl_var['userhash']){ ?>
		</div>
	</div>
</div>
</body>
</html>
<?php } ?>