<?php $this->_compileInclude('header'); ?><body><?php $this->_compileInclude('nav'); ?><div class="container-fluid">	<div class="row-fluid">		<div class="span2">			<?php $this->_compileInclude('menu'); ?>		</div>		<div class="span10">			<ul class="breadcrumb">				<li><a href="index.php?core-master">全局</a> <span class="divider">/</span></li>				<li class="active">模块管理</li>			</ul>			<table class="table table-hover">				<thead>					<tr>						<th>							模块标识						</th>						<th>							模块名称						</th>						<th>							状态						</th>						<th>							操作						</th>					</tr>				</thead>				<tbody>					<?php $aid = 0;
 foreach($this->tpl_var['localapps']['dir'] as $key => $lapp){ 
 $aid++; ?>					<tr>						<td><?php echo $lapp['name']; ?></td>						<td>							<?php if($this->tpl_var['apps'][$lapp['name']]){ ?><?php echo $this->tpl_var['apps'][$lapp['name']]['appname']; ?><?php } else { ?>未设置<?php } ?>						</td>						<td>							<?php if($this->tpl_var['apps'][$lapp['name']]['appstatus']){ ?>正常<?php } else { ?>禁用<?php } ?>						</td>						<td>							<a class="btn" href="index.php?core-master-apps-config&appid=<?php echo $lapp['name']; ?>"><em class="icon-cog"></em></a>						</td>					</tr>					<?php } ?>				</tbody>			</table>		</div>	</div></div></body></html>