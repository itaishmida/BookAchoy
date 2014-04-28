<?php
/**
 * Class that operate on table 'book'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-04-28 18:19
 */
class BookMySqlDAO implements BookDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return BookMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM book WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM book';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM book ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param book primary key
 	 */
	public function delete($id){
		$sql = 'DELETE FROM book WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param BookMySql book
 	 */
	public function insert($book){
		$sql = 'INSERT INTO book (name, genre, overall_rating) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($book->name);
		$sqlQuery->set($book->genre);
		$sqlQuery->setNumber($book->overallRating);

		$id = $this->executeInsert($sqlQuery);	
		$book->id = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param BookMySql book
 	 */
	public function update($book){
		$sql = 'UPDATE book SET name = ?, genre = ?, overall_rating = ? WHERE id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($book->name);
		$sqlQuery->set($book->genre);
		$sqlQuery->setNumber($book->overallRating);

		$sqlQuery->setNumber($book->id);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM book';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByName($value){
		$sql = 'SELECT * FROM book WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByGenre($value){
		$sql = 'SELECT * FROM book WHERE genre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByOverallRating($value){
		$sql = 'SELECT * FROM book WHERE overall_rating = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByName($value){
		$sql = 'DELETE FROM book WHERE name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByGenre($value){
		$sql = 'DELETE FROM book WHERE genre = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByOverallRating($value){
		$sql = 'DELETE FROM book WHERE overall_rating = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return BookMySql 
	 */
	protected function readRow($row){
		$book = new Book();
		
		$book->id = $row['id'];
		$book->name = $row['name'];
		$book->genre = $row['genre'];
		$book->overallRating = $row['overall_rating'];

		return $book;
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
	 * @return BookMySql 
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