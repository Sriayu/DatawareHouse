<?php
class CheckAuthFilter extends CFilter
{
    //Dipanggil sesaat sebelum action dijalankan
    protected function preFilter($filterChain)
    {
        if(!Yii::app()->user->isGuest)
        {
            $conName    = Yii::app()->controller->Id;         //Baca nama controller yg sedang diakses
            $actName    = Yii::app()->controller->action->id;  //Baca nama action yg sedang diakses
         
            $idx        = Yii::app()->user->id;                   //Ambil ID user yg sedang login
            $idMenu     = TMenu::model()->conidx($conName);       //Ambil ID menu yg sedang diakses dari database
            $id = TUser::model()->findByAttributes(array('id' => $idx));
            
            $criteria   = new CDbCriteria;
            $criteria->condition='user_id=:user_id AND menu_id=:menu_id';
            $criteria->params=array(':user_id'=>$id->id,':menu_id'=>$idMenu);
            $access     = TMenuPrivileges::model()->with('menu')->find($criteria);
            $reCheck    = TMenu::model()->checkAuth($actName);
            //$access->$reCheck;
             
            if(!$access->$reCheck){
                throw new CHttpException('','You are not authorized to perform this action.');
                return false;
            }
            else
                return true;
        }else
            throw new CHttpException('','You must login before.');
            return false;
    }
     
    //Dipanggil setelah action selesai dijalankan
    protected function postFilter($filterChain)
    {
        //Your code here
    }
}