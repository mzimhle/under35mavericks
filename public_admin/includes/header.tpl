<div id="header">
    <!-- Start Heading -->
        
    <div id="heading">
        <div id="ct_logo">

        </div>
    </div><!-- End Heading -->
	 {if isset($admin)}
    <!-- Start Top Nav -->
    <div id="topnav"> 
            <ul>
                <li><a href="/" title="Home" {if $page eq '/' or $page eq ''} class="active"{/if}>Home</a></li>
				<li><a href="/participants/" title="Members" {if $page eq 'participants'} class="active"{/if}>Members</a></li>
				<li><a href="/company/" title="Company" {if $page eq 'company'} class="active"{/if}>Company</a></li>
				<li><a href="/gallery/" title="Gallery" {if $page eq 'gallery'} class="active"{/if}>Gallery</a></li>
				<li><a href="/event/" title="Event" {if $page eq 'event'} class="active"{/if}>Event</a></li>
				<li><a href="/awards/" title="Awards" {if $page eq 'awards'} class="active"{/if}>Awards</a></li>
				<li><a href="/resources/" title="Resources" {if $page eq 'resources'} class="active"{/if}>Resources</a></li>
            </ul>
    </div><!-- End Top Nav -->
  <div class="clearer"><!-- --></div>
  {/if}
</div><!--header-->
{if isset($admin)}
    <div class="logged_in">
        <ul>
            <li><a href="/logout.php" title="Logout">Logout</a></li>
        </ul>
    </div><!--logged_in-->
	{/if}
  	<br />