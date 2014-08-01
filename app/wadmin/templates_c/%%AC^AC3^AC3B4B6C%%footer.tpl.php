<?php /* Smarty version 2.6.26, created on 2012-05-14 09:35:39
         compiled from boxslots/footer.tpl */ ?>
<?php if ($this->_tpl_vars['langchange']): ?><div align="right"><?php echo $this->_tpl_vars['setlanguage']; ?>
</div><br /><?php endif; ?>
  </div> 
  </div>
  <div id="content-b"></div>
  </div>
  <div id="side_menu">
    <div id="side_menu_top"></div>
    <div id="side_menu_bg">
      <div id="side_menu_align">
        <p class="header"><?php echo $this->_tpl_vars['LANG']['quicknav']; ?>
</p>
        <ul id="sidenavlinks">
          <li><a href="index.php"><img class="nav-icon" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/home.png" alt="<?php echo $this->_tpl_vars['LANG']['globalsystemname']; ?>
"><span>Inicio</span></a></li>
          <li><a href="clientarea.php"><img class="nav-icon" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/client.png" alt="<?php echo $this->_tpl_vars['LANG']['clientareatitle']; ?>
"><span><?php echo $this->_tpl_vars['LANG']['clientareatitle']; ?>
</span></a></li>
          <li><a href="announcements.php" title="<?php echo $this->_tpl_vars['LANG']['announcementstitle']; ?>
"><img class="nav-icon" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/info.png" alt="<?php echo $this->_tpl_vars['LANG']['announcementstitle']; ?>
"><span><?php echo $this->_tpl_vars['LANG']['announcementstitle']; ?>
</span></a></li>
          <li><a href="knowledgebase.php" title="<?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
"><img class="nav-icon" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/faq.png" alt="<?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
"><span><?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
</span></a></li>
          <li><a href="submitticket.php" title="<?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
"><img class="nav-icon" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/mail.png" alt="<?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
"><span><?php echo $this->_tpl_vars['LANG']['supportticketssubmitticket']; ?>
</span></a></li>
          <li><a href="downloads.php" title="<?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
"><img class="nav-icon" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/download.png" alt="<?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
"><span><?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
</span></a></li>
          <li><a href="cart.php" title="<?php echo $this->_tpl_vars['LANG']['ordertitle']; ?>
"><img class="nav-icon" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/cart.png" alt="<?php echo $this->_tpl_vars['LANG']['ordertitle']; ?>
"><span><?php echo $this->_tpl_vars['LANG']['ordertitle']; ?>
</span></a></li>
          <?php if ($this->_tpl_vars['loggedin']): ?>
          <li><a href="submitticket.php?step=2&deptid=1" title="Registre los pagos de sus servicios."><img class="nav-icon" src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/nav-order.png" alt="Registre los pagos de sus servicios."><span>Registre su Pago</span></a></li>
          <?php endif; ?>
        </ul>
<?php if ($this->_tpl_vars['livehelp']): ?>
<p class="header"><?php echo $this->_tpl_vars['LANG']['chatlivehelp']; ?>
</p>
<?php echo $this->_tpl_vars['livehelp']; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['loggedin']): ?></div>
      <div class="side_menu_sep"></div>
      <div id="side_menu_align">
        <p class="header"><?php echo $this->_tpl_vars['LANG']['accountinfo']; ?>
</p>
        <p><strong><?php echo $this->_tpl_vars['clientsdetails']['firstname']; ?>
 <?php echo $this->_tpl_vars['clientsdetails']['lastname']; ?>
 <?php if ($this->_tpl_vars['clientsdetails']['companyname']): ?>(<?php echo $this->_tpl_vars['clientsdetails']['companyname']; ?>
)<?php endif; ?></strong><br />
<?php echo $this->_tpl_vars['clientsdetails']['address1']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['address2']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['city']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['state']; ?>
, <?php echo $this->_tpl_vars['clientsdetails']['postcode']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['countryname']; ?>
<br />
<?php echo $this->_tpl_vars['clientsdetails']['email']; ?>
<br /><br />
<?php if ($this->_tpl_vars['addfundsenabled']): ?><img src="templates/<?php echo $this->_tpl_vars['template']; ?>
/images/icons/money.gif" alt="Add Funds" width="22" height="22" border="0" class="absmiddle" /> <a href="clientarea.php?action=addfunds"><?php echo $this->_tpl_vars['LANG']['addfunds']; ?>
</a><?php endif; ?></p>
      </div>
      <div class="side_menu_sep"></div>
      <div id="side_menu_align">
        <p class="header"><?php echo $this->_tpl_vars['LANG']['accountstats']; ?>
</p>
        <p><?php echo $this->_tpl_vars['LANG']['statsnumproducts']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['productsnumactive']; ?>
</strong> (<?php echo $this->_tpl_vars['clientsstats']['productsnumtotal']; ?>
)<br />
<?php echo $this->_tpl_vars['LANG']['statsnumdomains']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['numactivedomains']; ?>
</strong> (<?php echo $this->_tpl_vars['clientsstats']['numdomains']; ?>
)<br />
<?php echo $this->_tpl_vars['LANG']['statsnumtickets']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['numtickets']; ?>
</strong><br />
<?php echo $this->_tpl_vars['LANG']['statsnumreferredsignups']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['numaffiliatesignups']; ?>
</strong><br />
<?php echo $this->_tpl_vars['LANG']['statscreditbalance']; ?>
: <strong><?php echo $this->_tpl_vars['clientsstats']['creditbalance']; ?>
</strong><br />
<?php echo $this->_tpl_vars['LANG']['statsdueinvoicesbalance']; ?>
: <strong><?php if ($this->_tpl_vars['clientsstats']['numdueinvoices'] > 0): ?><span class="red"><?php endif; ?><?php echo $this->_tpl_vars['clientsstats']['dueinvoicesbalance']; ?>
<?php if ($this->_tpl_vars['clientsstats']['numdueinvoices'] > 0): ?></span><?php endif; ?></strong></p>
<?php else: ?>
<form method="post" action="<?php echo $this->_tpl_vars['systemsslurl']; ?>
dologin.php">
  <p class="header"><?php echo $this->_tpl_vars['LANG']['clientlogin']; ?>
</p>
  <p><strong><?php echo $this->_tpl_vars['LANG']['email']; ?>
</strong><br />
    <input name="username" type="text" size="25" />
  </p>
  <p><strong><?php echo $this->_tpl_vars['LANG']['loginpassword']; ?>
</strong><br />
    <input name="password" type="password" size="25" />
  </p>
  <p>
    <input type="checkbox" name="rememberme" />
    <?php echo $this->_tpl_vars['LANG']['loginrememberme']; ?>
</p>
  <p>
    <input type="submit" class="submitbutton" value="<?php echo $this->_tpl_vars['LANG']['loginbutton']; ?>
" />
  </p>
</form>
  <p class="header"><?php echo $this->_tpl_vars['LANG']['knowledgebasesearch']; ?>
</p>
<form method="post" action="knowledgebase.php?action=search">
  <p>
    <input name="search" type="text" size="25" /><br />
    <select name="searchin">
      <option value="Knowledgebase"><?php echo $this->_tpl_vars['LANG']['knowledgebasetitle']; ?>
</option>
      <option value="Downloads"><?php echo $this->_tpl_vars['LANG']['downloadstitle']; ?>
</option>
    </select>
    <input type="submit" value="<?php echo $this->_tpl_vars['LANG']['go']; ?>
" />
  </p>
</form>
<?php endif; ?>   				
	</div>
	</div>
    <div id="side_menu_bottom"></div>
  </div>
<?php if ($this->_tpl_vars['twitterusername']): ?><br />
<p align="center"><a href="http://twitter.com/<?php echo $this->_tpl_vars['twitterusername']; ?>
" target="_blank"><img src="images/twitterfollow.png" width="150" border="0" alt="<?php echo $this->_tpl_vars['LANG']['twitterfollow']; ?>
" /></a></p>
<?php endif; ?>
  </div>
  <div class="clear"></div>
  </div>

</div>
</div>
</body>
</html>