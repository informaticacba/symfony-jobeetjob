<?php

/**
 * JobeetJob
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    jobeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class JobeetJob extends BaseJobeetJob
{
	//	Reescribiendo el metodo toString
	public function __toString(){
		return sprintf('%s at %s (%s)', $this->getPosition(), $this->getCompany(), $this->getLocation());
	}

	//	Funciones para hacer URLs Friendly

	//	Retorna la prop company reemplazando caract no ASCCI por - (guion medio)
	public function getCompanySlug(){
		return Jobeet::slugify($this->getCompany());
	}

	//	Retorna la prop position reemplazando caract no ASCCI por - (guion medio)
	public function getPositionSlug(){
		return Jobeet::slugify($this->getPosition());
	}

	//	Retorna la prop location reemplazando caract no ASCCI por - (guion medio)
	public function getLocationSlug(){
		return Jobeet::slugify($this->getLocation());
	}

	//	Fin funciones URLs Firendly

	//	Reescribiendo metodo save()
	public function save(Doctrine_Connection $conn = null){
		
		//	Al poblar la DB comentar el if, despues descomentarlo
		//	Si no valido que idNew exista genera un error al poblar la DB
		if(isset($this->idNew) && $this->idNew() && !$this->getExpiresAt()){
			$now = $this->getCreatedAt() ? $this->getDateTimeObject('created_at')->format('U') : time();
			//$this->setExpiresAt(date('Y-m-d H:i:s', $now + 86400 * 30));

			//	Trabajando con parametros de la app
			$this->setExpiresAt(date('Y-m-d H:i:s', $now + 86400 * sfConfig::get('app_active_days')));
		}

		return parent::save($conn);
	}
}
