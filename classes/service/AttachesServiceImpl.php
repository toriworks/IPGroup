<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 10. 27
 * Time: 오후 2:22
 * To change this template use File | Settings | File Templates.
 */

@define('class_path', '/home/hosting_users/ipgroup1/www');
require_once(class_path."/classes/service/IAttachesService.php");
require_once(class_path."/classes/dao/AttachesDaoImpl.php");
class AttachesServiceImpl implements IAttachesService {

    private $attachesDao;

    /**
     * @param mixed $attachesDao
     */
    public function setAttachesDao($attachesDao)
    {
        $this->attachesDao = $attachesDao;
    }

    public function add($conn, Attaches $obj)
    {
        $this->attachesDao->add($conn, $obj);
    }

    public function update($conn, Attaches $obj)
    {
        // TODO: Implement update() method.
    }

    public function delete($conn, Attaches $obj)
    {
        return $this->attachesDao->delete($conn, $obj);
    }

    public function lists($conn, $id)
    {
        return $this->attachesDao->lists($conn, $id);
    }

    public function listsCount($conn, $wParam)
    {
        // TODO: Implement listsCount() method.
    }
}