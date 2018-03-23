<header>
	<link rel="stylesheet" type="text/css" href="style/mousecontext.css?v=<?=time();?>" media="screen" />
</header>
<nav class="context-menu">
  <ul class="context-menu__items">
    <li class="context-menu__item">
      <a href="#" class="context-menu__link" data-action="new_worker">
        <i class="fa fa-eye"></i> Naujas darbuotojas 
      </a>
    </li>
	<div class="for-worker">
    <li class="context-menu__item">
      <a href="#" class="context-menu__link" data-action="delete_worker">
        <i class="fa fa-edit"></i> Ištrinti darbuotoje 
      </a>
    </li>
    <li class="context-menu__item">
      <a href="#" class="context-menu__link" data-action="new_task" >
        <i class="fa fa-times"></i> Nauja užduotis
      </a>
    </li>
	<div class="for-task">
	<li class="context-menu__item">
      <a href="#" class="context-menu__link" data-action="delete_task">
        <i class="fa fa-times"></i> Ištrinti užduotį 
      </a>
    </li>
	</div>
	</div>
  </ul>
</nav>

<script type="text/javascript" src="scripts/mousecontext.js?v=<?=time();?>"></script>