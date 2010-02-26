<?php
/**
 * @file
 * @package lecat
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
    exit;
}

require_once LECAT_TRUST_PATH . '/class/AbstractEditAction.class.php';

/**
 * Lecat_CatEditAction
**/
class Lecat_CatEditAction extends Lecat_AbstractEditAction
{
    /**
     * _getId
     * 
     * @param   void
     * 
     * @return  int
    **/
    protected function _getId()
    {
        return $this->mRoot->mContext->mRequest->getRequest('cat_id');
    }

    /**
     * &_getHandler
     * 
     * @param   void
     * 
     * @return  Lecat_CatHandler
    **/
    protected function &_getHandler()
    {
        $handler =& $this->mAsset->getObject('handler', 'cat');
        return $handler;
    }

    /**
     * _setupActionForm
     * 
     * @param   void
     * 
     * @return  void
    **/
    protected function _setupActionForm()
    {
        // $this->mActionForm =new Lecat_CatEditForm();
        $this->mActionForm =& $this->mAsset->getObject('form', 'cat',false,'edit');
        $this->mActionForm->prepare();
    }

    /**
     * _setupRequest
     * 
     * @param   void
     * 
     * @return  void
    **/
	protected function _setupRequest()
	{
		//set parent category if requested
		if($this->mRoot->mContext->mRequest->getRequest('p_id')){
			$this->mObject->set('p_id', $this->mRoot->mContext->mRequest->getRequest('p_id'));
			$this->mObject->loadPcat();
			$this->mObject->set('gr_id', $this->mObject->mPcat->get('gr_id'));
		}
		//set category group if requested
		elseif($this->mRoot->mContext->mRequest->getRequest('gr_id')){
			$this->mObject->set('gr_id', $this->mRoot->mContext->mRequest->getRequest('gr_id'));
		}
		else{
			$this->mRoot->mController->executeRedirect("./index.php?action=GrEdit", 1, _MD_LECAT_ERROR_NO_GROUP_REQUESTED);
		}
	}

    /**
     * prepare
     * 
     * @param   void
     * 
     * @return  void
    **/
	public function prepare()
	{
		parent::prepare();
	
		//add new record
		if ($this->mObject->isNew()) {
			$this->_setupRequest();
		}
		else{		//load permission data if not new category
			$this->mObject->loadPcat();
			$this->mObject->loadPermit();
		}
	
		$this->mObject->loadGr();
	
		//check specified modules name in the current and parent cats.
		$reqModulesArr = explode(',', $this->mRoot->mContext->mRequest->getRequest('modules'));
		if($reqModulesArr){
			$modulesArr = array();
			$resultArr = array();
			//check limitation in parent categories
			$this->mObject->loadCatPath();
			foreach(array_keys($this->mObject->mCatPath['modules']) as $keyP){
				if($this->mObject->mCatPath['modules'][$keyP]){
					$modulesArr = explode(',', $this->mObject->mCatPath['modules'][$keyP]);
					break 1;
				}
			}
			//search parent categories' modules limitation
			foreach(array_keys($reqModulesArr) as $key){
				if(in_array($reqModulesArr[$key], $modulesArr)){
					$resultArr[] = $reqModulesArr[$key];
				}
			}
			if($resultArr){
				$_POST['modules'] = implode(',', $resultArr);
			}
		}
	}

    /**
     * executeViewInput
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
    {
		//load Category for Parent Selection
		$catCriteria=new CriteriaCompo();
		$catCriteria->add(new Criteria('gr_id', $this->mObject->get('gr_id')));
		if($this->mObject->get('cat_id')){
			$catCriteria->add(new Criteria('cat_id', $this->mObject->get('cat_id'), '!='));
		}
		$catHandler = $this->_getHandler();
		$catArr = $catHandler->getObjects($catCriteria);
	
		//remove descendant categories
		$deepest = 0;	//the deepest category level in given category's descendant
		foreach(array_keys($catArr) as $keyD){
			$catArr[$keyD]->loadCatPath();
			//var_dump($catArr[$keyD]->mCatPath);
			if(is_array($catArr[$keyD]->mCatPath['cat_id']) && in_array($this->mObject->get('cat_id'), $catArr[$keyD]->mCatPath['cat_id'])){
				if($deepest<$catArr[$keyD]->getDepth()){
					$deepest = $catArr[$keyD]->getDepth();
				}
				unset($catArr[$keyD]);
			}
		}
		//remove depth limit overed categories
		$limit = $this->mObject->mGr->get('level');
		if($limit!=0){	//limit==0 means unlimited depth
			foreach(array_keys($catArr) as $keyL){
				if($limit<$catArr[$keyL]->getDepth()+$deepest-$this->mObject->getDepth()+1||$limit<$catArr[$keyL]->getDepth()+1){
					unset($catArr[$keyL]);
				}
			}
		}
	
		//set renders
        $render->setTemplateName($this->mAsset->mDirname . '_cat_edit.html');
		$render->setAttribute('actionForm', $this->mActionForm);
		$render->setAttribute('object', $this->mObject);
		$render->setAttribute('catArr', $catArr);
    }

    /**
     * executeViewSuccess
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
    {
        $this->mRoot->mController->executeForward('./index.php?action=CatView&cat_id='. $this->mObject->getShow('cat_id'));
    }

    /**
     * executeViewError
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewError(/*** XCube_RenderTarget ***/ &$render)
    {
        $this->mRoot->mController->executeRedirect('./index.php?action=CatList', 1, _MD_LECAT_ERROR_DBUPDATE_FAILED);
    }

    /**
     * executeViewCancel
     * 
     * @param   XCube_RenderTarget  &$render
     * 
     * @return  void
    **/
    public function executeViewCancel(/*** XCube_RenderTarget ***/ &$render)
    {
        $this->mRoot->mController->executeForward('./index.php?action=CatView&cat_id='. $this->mObject->getShow('cat_id'));
    }
}

?>
