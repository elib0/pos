<?php /* Smarty version 2.6.26, created on 2012-09-13 21:53:25
         compiled from /home/websarro/public_html/wadmin/templates/boxslots/clientareadomaindetails.tpl */ ?>
<h2><?php echo $this->_tpl_vars['LANG']['clientareanavdomains']; ?>
</h2>
<table width="100%" cellspacing="0" cellpadding="0" class="frame">
  <tr>
    <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td class="fieldarea" width="150"><?php echo $this->_tpl_vars['LANG']['clientareahostingregdate']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['registrationdate']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareahostingdomain']; ?>
:</td>
          <td><a href="http://<?php echo $this->_tpl_vars['domain']; ?>
" target="_blank"><?php echo $this->_tpl_vars['domain']; ?>
</a></td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['orderpaymentmethod']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['paymentmethod']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['firstpaymentamount']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['firstpaymentamount']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['recurringamount']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['recurringamount']; ?>
</td>
        </tr>
        <?php if ($this->_tpl_vars['recreatesubscriptionbutton']): ?>
        <tr>
          <td></td>
          <td><?php echo $this->_tpl_vars['recreatesubscriptionbutton']; ?>
</td>
        </tr>
        <?php endif; ?>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareahostingnextduedate']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['nextduedate']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientarearegistrationperiod']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['registrationperiod']; ?>
 <?php echo $this->_tpl_vars['LANG']['orderyears']; ?>
</td>
        </tr>
        <tr>
          <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['clientareastatus']; ?>
:</td>
          <td><?php echo $this->_tpl_vars['status']; ?>
</td>
        </tr>
    </table></td>
  </tr>
</table>
<br />
<?php if ($this->_tpl_vars['status'] == $this->_tpl_vars['LANG']['clientareaactive']): ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domaindetails">
  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
  <h3><?php echo $this->_tpl_vars['LANG']['domainsautorenew']; ?>
</h3>
  <?php if ($this->_tpl_vars['donotrenew']): ?>
  <div class="errorbox"><?php echo $this->_tpl_vars['LANG']['domainsautorenewdisabledwarning']; ?>
</div>
  <br>
  <?php endif; ?>
  <p><?php echo $this->_tpl_vars['LANG']['domainsautorenewstatus']; ?>
: <?php if ($this->_tpl_vars['donotrenew']): ?><?php echo $this->_tpl_vars['LANG']['domainsautorenewdisabled']; ?>
 &nbsp;&nbsp;&nbsp;
    <input type="hidden" name="autorenew" value="enable">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domainsautorenewenable']; ?>
" class="button">
    <?php else: ?><?php echo $this->_tpl_vars['LANG']['domainsautorenewenabled']; ?>
 &nbsp;&nbsp;&nbsp;
    <input type="hidden" name="autorenew" value="disable">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domainsautorenewdisable']; ?>
" class="button">
    <?php endif; ?></p>
</form>
<?php if ($this->_tpl_vars['managens']): ?>
<h3><?php echo $this->_tpl_vars['LANG']['domainnameservers']; ?>
</h3>
<?php if ($this->_tpl_vars['error']): ?>
<div class="errorbox"><?php echo $this->_tpl_vars['error']; ?>
</div>
<br />
<?php endif; ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domaindetails">
  <input type="hidden" name="sub" value="savens">
  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td class="fieldarea" width="150"><?php echo $this->_tpl_vars['LANG']['domainnameserver1']; ?>
:</td>
            <td><input type="text" name="ns1" value="<?php echo $this->_tpl_vars['ns1']; ?>
" size="40"></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['domainnameserver2']; ?>
:</td>
            <td><input type="text" name="ns2" value="<?php echo $this->_tpl_vars['ns2']; ?>
" size="40"></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['domainnameserver3']; ?>
:</td>
            <td><input type="text" name="ns3" value="<?php echo $this->_tpl_vars['ns3']; ?>
" size="40"></td>
          </tr>
          <tr>
            <td class="fieldarea"><?php echo $this->_tpl_vars['LANG']['domainnameserver4']; ?>
:</td>
            <td><input type="text" name="ns4" value="<?php echo $this->_tpl_vars['ns4']; ?>
" size="40"></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['clientareasavechanges']; ?>
" class="button">
  </p>
</form>
<?php endif; ?>

<?php if ($this->_tpl_vars['lockstatus']): ?>
<?php if ($this->_tpl_vars['tld'] != "co.uk" && $this->_tpl_vars['tld'] != "org.uk" && $this->_tpl_vars['tld'] != "ltd.uk" && $this->_tpl_vars['tld'] != "plc.uk" && $this->_tpl_vars['tld'] != "me.uk"): ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domaindetails">
  <input type="hidden" name="sub" value="savereglock">
  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
  <h3><?php echo $this->_tpl_vars['LANG']['domainregistrarlock']; ?>
</h3>
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td class="fieldarea" width="150"><?php echo $this->_tpl_vars['LANG']['domainregistrarlock']; ?>
:</td>
            <td><input type="checkbox" name="reglock"<?php if ($this->_tpl_vars['lockstatus'] == 'locked'): ?> checked<?php endif; ?>>
              <?php echo $this->_tpl_vars['LANG']['domainregistrarlockdesc']; ?>
</td>
          </tr>
      </table></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['clientareasavechanges']; ?>
" class="button">
  </p>
</form>
<?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['releasedomain']): ?>
<h3><?php echo $this->_tpl_vars['LANG']['domainrelease']; ?>
</h3>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domaindetails">
  <input type="hidden" name="sub" value="releasedomain">
  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
  <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td class="fieldarea" width="150"><?php echo $this->_tpl_vars['LANG']['domainreleasetag']; ?>
:</td>
            <td><input type="text" name="transtag" size="20" /> <?php echo $this->_tpl_vars['LANG']['domainreleasedescription']; ?>
</td>
          </tr>
      </table></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domainrelease']; ?>
" class="buttonwarn">
  </p>
</form>
<?php endif; ?>

<?php endif; ?>
<h3><strong><?php echo $this->_tpl_vars['LANG']['domainmanagementtools']; ?>
</strong></h3>
<table border="0" align="center" cellpadding="10" cellspacing="0">
  <tr> <?php if ($this->_tpl_vars['renew']): ?>
    <td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domainrenew">
        <input type="hidden" name="domainid" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
        <p align="center">
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domainrenew']; ?>
" class="button">
        </p>
      </form></td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['managecontacts']): ?>
    <td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domaincontacts">
        <input type="hidden" name="domainid" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
        <p align="center">
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domaincontactinfo']; ?>
" class="button">
        </p>
      </form></td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['emailforwarding']): ?>
    <td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domainemailforwarding">
        <input type="hidden" name="domainid" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
        <p align="center">
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domainemailforwarding']; ?>
" class="button">
        </p>
      </form></td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['dnsmanagement']): ?>
    <td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domaindns">
        <input type="hidden" name="domainid" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
        <p align="center">
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domaindnsmanagement']; ?>
" class="button">
        </p>
      </form></td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['getepp']): ?>
    <td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domaingetepp">
        <input type="hidden" name="domainid" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
        <p align="center">
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domaingeteppcode']; ?>
" class="button">
        </p>
      </form></td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['registerns']): ?>
    <td><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
?action=domainregisterns">
        <input type="hidden" name="domainid" value="<?php echo $this->_tpl_vars['domainid']; ?>
">
        <p align="center">
          <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['domainregisterns']; ?>
" class="button">
        </p>
      </form></td>
    <?php endif; ?> </tr>
</table>

<p align="center"><input type="button" value="<?php echo $this->_tpl_vars['LANG']['clientareabacklink']; ?>
" onclick="window.location='clientarea.php?action=domains'" class="button" /></p>