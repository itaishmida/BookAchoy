<?php
/**
 * Class that operate on table 'users_read_books'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-04-28 18:19
 */
class UsersReadBooksMySqlDAO implements UsersReadBooksDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return UsersReadBooksMySql 
	 */
	public function load($userId, $bookId){
		$sql = 'SELECT * FROM users_read_books WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userId);
		$sqlQuery->setNumber($bookId);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM users_read_books';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM users_read_books ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param usersReadBook primary key
 	 */
	public function delete($userId, $bookId){
		$sql = 'DELETE FROM users_read_books WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userId);
		$sqlQuery->setNumber($bookId);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param UsersReadBooksMySql usersReadBook
 	 */
	public function insert($usersReadBook){
		$sql = 'INSERT INTO users_read_books ( user_id, book_id) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($usersReadBook->userId);

		$sqlQuery->setNumber($usersReadBook->bookId);

		$this->executeInsert($sqlQuery);	
		//$usersReadBook->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param UsersReadBooksMySql usersReadBook
 	 */
	public function update($usersReadBook){
		$sql = 'UPDATE users_read_books SET  WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($usersReadBook->userId);

		$sqlQuery->setNumber($usersReadBook->bookId);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM users_read_books';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return UsersReadBooksMySql 
	 */
	protected function readRow($row){
		$usersReadBook = new UsersReadBook();
		
		$usersReadBook->userId = $row['user_id'];
		$usersReadBook->bookId = $row['book_id'];

		return $usersReadBook;
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
	 * @return UsersReadBooksMySql 
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