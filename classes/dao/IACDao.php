<?php
/**
 * User: IACDao (toriworks@gmail.com)
 * Date: 13. 11. 1
 * Time: 오후 4:50
 */

interface IACDao {
    public function add($conn, ApplicantsCompany $obj);
    public function update($conn, ApplicantsCompany $obj);
    public function delete($conn, ApplicantsCompany $obj);
    public function lists($conn, ApplicantsCompany $obj);
    public function listsCount($conn, ApplicantsCompany $obj);
}