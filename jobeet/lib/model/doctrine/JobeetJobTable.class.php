<?php

/**
 * JobeetJobTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class JobeetJobTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object JobeetJobTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('JobeetJob');
    }

    //	Retorna todos los Jobs activos
    public function getActivesJobs(Doctrine_Query $query = null){
        $query = is_null($query) ? Doctrine_Query::create()->from('JobeetJob j') : $query;

        return $query->andWhere('j.expires_at > ?', date('Y-m-d h:i:s', time()))
            ->addOrderBy('j.expires_at DESC')
            ->execute();
    }
}