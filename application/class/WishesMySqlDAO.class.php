<?php
/**
 * Class that operate on table 'wishes'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-04-28 18:20
 */
class WishesMySqlDAO implements WishesDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return WishesMySql 
	 */
	public function load($userId, $bookId){
		$sql = 'SELECT * FROM wishes WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userId);
		$sqlQuery->setNumber($bookId);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM wishes';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM wishes ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param wishe primary key
 	 */
	public function delete($userId, $bookId){
		$sql = 'DELETE FROM wishes WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userId);
		$sqlQuery->setNumber($bookId);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param WishesMySql wishe
 	 */
	public function insert($wishe){
		$sql = 'INSERT INTO wishes (wish_date, user_id, book_id) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($wishe->wishDate);

		
		$sqlQuery->setNumber($wishe->userId);

		$sqlQuery->setNumber($wishe->bookId);

		$this->executeInsert($sqlQuery);	
		//$wishe->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param WishesMySql wishe
 	 */
	public function update($wishe){
		$sql = 'UPDATE wishes SET wish_date = ? WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($wishe->wishDate);

		
		$sqlQuery->setNumber($wishe->userId);

		$sqlQuery->setNumber($wishe->bookId);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM wishes';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByWishDate($value){
		$sql = 'SELECT * FROM wishes WHERE wish_date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByWishDate($value){
		$sql = 'DELETE FROM wishes WHERE wish_date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return WishesMySql 
	 */
	protected function readRow($row){
		$wishe = new Wishe();
		
		$wishe->userId = $row['user_id'];
		$wishe->bookId = $row['book_id'];
		$wishe->wishDate = $row['wish_date'];

		return $wishe;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return WishesMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>