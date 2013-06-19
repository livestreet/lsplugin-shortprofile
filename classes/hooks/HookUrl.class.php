<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

class PluginShortprofile_HookUrl extends Hook {

    public function RegisterHook() {
        $this->AddHook('init_action', 'InitAction',__CLASS__,10000);
    }

    public function InitAction() {
		/**
		 * Подхватываем обработку URL
		 */
    	if (Router::GetAction()=='error' and Router::GetActionEvent()=='shortprofile') {
			$aParamsNew=$aParamsReal=Router::GetParams();
			$sLogin=$sActionReal=array_shift($aParamsReal);
			$sEventReal=array_shift($aParamsReal);
			/**
			 * Проверка на стандартный экшен
			 */
			$bCheckAction=true;
			$sActionCheck=$sLogin;
			$sRewriteAction=Router::getInstance()->Rewrite($sActionCheck);
			$sStandartAction=Router::getInstance()->Standart($sActionCheck);
			if ($sRewriteAction!=$sActionCheck) {
				/**
				 * Используются реврайты, запросили "старый" экшен
				 * Проверять на стандартный экшен не нужно, можно сразу переходит к проверке логина
				 */
				$bCheckAction=false;
			}
			if ($sStandartAction!=$sActionCheck) {
				/**
				 * Используются реврайты, запросили "новый" экшен
				 * Нужно проверить на стандартных исходный экшен (до реврайта)
				 */
				$sActionCheck=$sStandartAction;
			}
			/**
			 * Если это не стандартный экшен
			 */
			if (!$bCheckAction or !Config::Get('router.page.'.$sActionCheck)) {
				/**
				 * Пользователь существует с таким логином?
				 */
				if ($oUser=$this->User_GetUserByLogin($sLogin)) {
					array_shift($aParamsNew);
					Router::Action('profile',$sLogin,$aParamsNew);
					return;
				}
			}
			/**
			 * Перенаправляем на исходный URL
			 */
			Router::Action($sActionReal,$sEventReal,$aParamsReal);
    	}
    }
}
?>