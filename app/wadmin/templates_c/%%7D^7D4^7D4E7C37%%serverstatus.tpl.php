<?php /* Smarty version 2.6.26, created on 2012-05-17 10:39:08
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/serverstatus.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_port_status', '/home/websarro/public_html/wadmin/templates/boxslots/serverstatus.tpl', 15, false),)), $this); ?>
<p><?php echo $this->_tpl_vars['LANG']['serverstatusheadingtext']; ?>
</p>
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" class="data">
  <tr>
    <th><?php echo $this->_tpl_vars['LANG']['servername']; ?>
</th>
    <th>HTTP</th>
    <th>FTP</th>
    <th>POP3</th>
    <th><?php echo $this->_tpl_vars['LANG']['serverstatusphpinfo']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['serverstatusserverload']; ?>
</th>
    <th><?php echo $this->_tpl_vars['LANG']['serverstatusuptime']; ?>
</th>
  </tr>
  <?php $_from = $this->_tpl_vars['servers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['server']):
?>
  <tr>
    <td><?php echo $this->_tpl_vars['server']['name']; ?>
</td>
    <td><?php echo getPortStatus(array('num' => ($this->_tpl_vars['num']),'port' => '80'), $this);?>
</td>
    <td><?php echo getPortStatus(array('num' => ($this->_tpl_vars['num']),'port' => '21'), $this);?>
</td>
    <td><?php echo getPortStatus(array('num' => ($this->_tpl_vars['num']),'port' => '110'), $this);?>
</td>
    <td><a href="<?php echo $this->_tpl_vars['server']['phpinfourl']; ?>
" target="_blank"><?php echo $this->_tpl_vars['LANG']['serverstatusphpinfo']; ?>
</a></td>
    <td><?php echo $this->_tpl_vars['server']['serverload']; ?>
</td>
    <td><?php echo $this->_tpl_vars['server']['uptime']; ?>
</td>
  </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="7"><?php echo $this->_tpl_vars['LANG']['serverstatusnoservers']; ?>
</td>
  </tr>
  <?php endif; unset($_from); ?>
</table><br />