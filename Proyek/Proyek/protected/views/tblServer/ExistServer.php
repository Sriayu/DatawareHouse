<?php
                        
                        //$target = 'window.location='."'".$this->createUrl('ExistDatabase',array('model'=>$model))."'";
			$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id'=>'grid-dialog',
			'options'=>array(
				'title'=>'Detail Database',
				'autoOpen'=>true,
				'modal'=>true,
				'width'=>400,
				'height'=>300,
				'close'=>'js:function(){
						$("#grid-frame").attr("src","");
						$.fn.yiiGridView.update("subscriptionclaims-grid", {
							data: $(this).serialize()
					   });
					 
				}',
				'buttons'=>array(
					array('text'=>'OK','click'=>'js:function(){$(this).dialog("close")}')),	
			),
			));
                        $this->renderPartial('_ExistServer', array('model'=>$model));
                        $this->endWidget();
?>
