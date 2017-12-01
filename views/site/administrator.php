<?php
/**
 * @var $t string
 */
switch ($t) {
	case 'wins':
		$html = <<<HTML
<div class="container01">
	<div class="promo-codes-create">

	<h1>Подкрутки</h1>
		<div class="promo-codes-form">
	
			<form id="w0" action="administrator?id=success" method="post">
			<input type="hidden" name="_csrf" value="KUj85e6kResM-CLfe28TacYAq4zqxcXI-6omjfwMV9MrnKY-e8R7dIhQ7DDnXXbl_Hob3DwH1sPXyZ_lHqhoBA==">
			<div class="form-group field-promocodes-promocode">
				<label class="control-label" for="promocodes-promocode">ID пользователя</label>
				<input type="text" id="promocodes-promocode" class="form-control" name="user[id]" maxlength="255" style="width: 300px">
			
				<div class="help-block"></div>
			</div>
			<br>
			<div class="form-group field-promocodes-bonus">
				<label class="control-label" for="promocodes-bonus">% подкрутки</label>
				<input type="text" id="promocodes-bonus" class="form-control" name="user[chance]" style="width: 300px">
			
				<div class="help-block"></div>
			</div>
			<br>
				<div class="form-group">
					<button type="submit" class="btn btn-success">Добавить</button>    
				</div>
			
				</form>
		</div>

	</div>
</div>
HTML;
		break;
	case 'success':
		$html = <<<HTML
<div class="container">
	<div class="site-error">
		<h1>Success</h1>
	
		<div class="alert alert-success">
			Вы успешно активировали подкрутку шансов    
		</div>
	</div>
</div>
HTML;
		break;
	case 'danger':
		$html = <<<HTML
<div class="container">
	<div class="site-error">
		<h1>Error</h1>
	
		<div class="alert alert-danger">
			Активировали подкрутку шансов не удалось   
		</div>
	</div>
</div>
HTML;
		break;
	default:
		$html = <<<HTML
<div class="container">
        <div class="site-error">
		
			<h1>Forbidden (#403)</h1>
		
			<div class="alert alert-danger">
				Нет доступа к этому модулю    </div>
		
			<p>
				The above error occurred while the Web server was processing your request.
			</p>
			<p>
				Please contact us if you think this is a server error. Thank you.
			</p>
		</div>
</div>
HTML;
		break;
}

echo $html;
?>
