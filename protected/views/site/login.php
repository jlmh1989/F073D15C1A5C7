<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
?>
<div class="form">
    <table class="login">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
        ));
        ?>
        <tr>
            <td class="login_header" colspan="2">Login</td>
        </tr>
        <tr>
            <td colspan="2">
                <img src="images/logo-web1.png" width="235" alt="e24">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="login_body">
                    <tr>
                        <td>
                            <?php echo $form->textField($model, 'username', array('placeholder' => 'username')); ?>
                            <?php echo $form->error($model, 'username'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->passwordField($model, 'password', array('placeholder' => 'password')); ?>
                            <?php echo $form->error($model, 'password'); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div class="row rememberMe">
                    <?php echo $form->checkBox($model, 'rememberMe'); ?>
                    <?php echo $form->label($model, 'rememberMe'); ?>
                    <?php echo $form->error($model, 'rememberMe'); ?>
                </div>
            </td>
            <td class="login_footer">
                <?php echo CHtml::submitButton('Login'); ?>
            </td>
        </tr>
        <?php $this->endWidget(); ?>
    </table>
</div><!-- form -->
