<?php
class Anuncios extends model {

 
	public function getMeusAnuncios() {
		

		$array = array();
		$sql = $this->db->prepare("SELECT
			*,
			(select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio = anuncios.id limit 1) as url
			FROM anuncios
			WHERE id_usuario = :id_usuario");
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}



	public function getMinhasEspecialidades() {
	  

		$array = array();
		$sql = $this->db->prepare("SELECT id,nome FROM especialidade WHERE id_usuario = :id_usuario ORDER BY nome");
			 
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}



	public function addQuemSomos($definicao, $objetivo, $como_surgiu, $helder_coelho,  $wagner_coelho) { // $fotos
		

		$sql = $this->db->prepare("INSERT INTO quem_somos 
			
			SET 
	    definicao = :definicao,
		objetivo = :objetivo,
		como_surgiu = :como_surgiu, 
		helder_coelho = :helder_coelho,
		wagner_coelho = :wagner_coelho, 
		id_usuario = :id_usuario   ");

		$sql->bindValue(":definicao", $definicao); //O que é 
		$sql->bindValue(":objetivo", $objetivo);
		$sql->bindValue(":como_surgiu", $como_surgiu);
		$sql->bindValue(":helder_coelho", $helder_coelho);
		$sql->bindValue(":wagner_coelho", $wagner_coelho); 
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
	 	 	
            try {
            $this->db->beginTransaction();
            $sql->execute();
            $id = $this->db->lastInsertId(); 
            $this->db->commit();
        } catch (\Throwable $th) {
            $this->db->rollback();
        }
     

		 
}





public function getMeusQuemSomos() {
		

		$array = array();
		$sql = $this->db->prepare("SELECT id,definicao,objetivo,como_surgiu,helder_coelho,wagner_coelho FROM quem_somos WHERE id_usuario = :id_usuario");
 
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}


	 

	public function getAnuncio($id) {
		$array = array();
		
 

		$sql = $this->db->prepare("SELECT id,titulo FROM anuncios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();

			$sql = $this->db->prepare("SELECT id,url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
			$sql->bindValue(":id_anuncio", $id);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}

		}

		return $array;
	}


public function getEspecialidade($id) {
		 
		$array = array();
		
 

		$sql = $this->db->prepare("SELECT id,nome FROM especialidade WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();

			$sql = $this->db->prepare("SELECT id,url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
			$sql->bindValue(":id_anuncio", $id);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}

		}

		return $array;
	}



public function getQuemSomos($id) {
		 
		$array = array();
		
 

		$sql = $this->db->prepare("SELECT id,definicao,objetivo,como_surgiu,helder_coelho,wagner_coelho FROM quem_somos WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();

			$sql = $this->db->prepare("SELECT id,url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
			$sql->bindValue(":id_anuncio", $id);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}

		}

		return $array;
	}




	public function addEspecialidade($nome) { 
		


 	    $id_usuario = $_SESSION['cLogin']; 

        $sql = $this->db->prepare("INSERT INTO especialidade SET id_usuario = :id_usuario,  nome = :nome");
					 
					$sql->bindValue(":id_usuario", $id_usuario);
					$sql->bindValue(":nome", $nome);
					$sql->execute();
       
}

	public function addAnuncio($titulo,   $fotos) { //, $fotos
		

		$sql = $this->db->prepare("INSERT INTO anuncios SET titulo = :titulo,  id_usuario = :id_usuario   ");
		$sql->bindValue(":titulo", $titulo); 
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
	 
		 	  
            try {
            $this->db->beginTransaction();
            $sql->execute();
            $id = $this->db->lastInsertId(); // esse é o ID que precisamos
            $this->db->commit();
        } catch (\Throwable $th) {
            $this->db->rollback();
        }
     

		if(count($fotos) > 0) {
			for($q=0;$q<count($fotos['tmp_name']);$q++) {
				$tipo = $fotos['type'][$q];
				if(in_array($tipo, array('image/jpeg', 'image/png'))) {
					$tmpname = md5(time().rand(0,9999)).'.png';
					move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/anuncios/'.$tmpname);

					list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/'.$tmpname);
					$ratio = $width_orig/$height_orig;

					$width = 1900;
					$height = 1200;

					if($width/$height > $ratio) {
						$width = $height*$ratio;
					} else {
						$height = $width/$ratio;
					}

					$img = imagecreatetruecolor($width, $height);
					if($tipo == 'image/jpeg') {
						$origi = imagecreatefromjpeg('assets/images/anuncios/'.$tmpname);
					} elseif($tipo == 'image/png') {
						$origi = imagecreatefrompng('assets/images/anuncios/'.$tmpname);
					}

					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					imagejpeg($img, 'assets/images/anuncios/'.$tmpname, 80);

					$sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio, url = :url");
					$sql->bindValue(":id_anuncio", $id);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();

				}
			}
		}
}


public function editEspecialidade($nome,   $id) {
		

		$sql = $this->db->prepare("UPDATE especialidade SET nome = :nome,  id_usuario = :id_usuario WHERE id = :id");
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']); 
		$sql->bindValue(":id", $id);
		$sql->execute();
 
	}

public function editQuemSomos($definicao, $objetivo, $como_surgiu, $helder_coelho,  $wagner_coelho,   $id) {
		

		$sql = $this->db->prepare("UPDATE quem_somos 
			SET 
		definicao = :definicao,
		objetivo = :objetivo,
		como_surgiu = :como_surgiu, 
		helder_coelho = :helder_coelho,
		wagner_coelho = :wagner_coelho,  
		id_usuario = :id_usuario 
		WHERE id = :id");
		$sql->bindValue(":definicao", $definicao); //O que é 
		$sql->bindValue(":objetivo", $objetivo);
		$sql->bindValue(":como_surgiu", $como_surgiu);
		$sql->bindValue(":helder_coelho", $helder_coelho);
		$sql->bindValue(":wagner_coelho", $wagner_coelho); 
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->bindValue(":id", $id);
		$sql->execute();
 
	}




	public function editAnuncio($titulo,   $fotos, $id) {
		

		$sql = $this->db->prepare("UPDATE anuncios SET titulo = :titulo,  id_usuario = :id_usuario WHERE id = :id");
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']); 
		$sql->bindValue(":id", $id);
		$sql->execute();

		if(count($fotos) > 0) {
			for($q=0;$q<count($fotos['tmp_name']);$q++) {
				$tipo = $fotos['type'][$q];
				if(in_array($tipo, array('image/jpeg', 'image/png'))) {
					$tmpname = md5(time().rand(0,9999)).'.jpg';
					move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/anuncios/'.$tmpname);

					list($width_orig, $height_orig) = getimagesize('assets/images/anuncios/'.$tmpname);
					$ratio = $width_orig/$height_orig;

					$width = 500;
					$height = 500;

					if($width/$height > $ratio) {
						$width = $height*$ratio;
					} else {
						$height = $width/$ratio;
					}

					$img = imagecreatetruecolor($width, $height);
					if($tipo == 'image/jpeg') {
						$origi = imagecreatefromjpeg('assets/images/anuncios/'.$tmpname);
					} elseif($tipo == 'image/png') {
						$origi = imagecreatefrompng('assets/images/anuncios/'.$tmpname);
					}

					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					imagejpeg($img, 'assets/images/anuncios/'.$tmpname, 80);

					$sql = $this->db->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio, url = :url");
					$sql->bindValue(":id_anuncio", $id);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();

				}
			}
		}

	}

	


	public function excluirQuemSomos($id) {
		
  
		$sql = $this->db->prepare("DELETE FROM quem_somos WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}
 

	public function excluirEspecialidade($id) {
		
  
		$sql = $this->db->prepare("DELETE FROM especialidade WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}


 

	public function excluirAnuncio($id) {
		

		$sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
		$sql->bindValue(":id_anuncio", $id);
		$sql->execute();

		$sql = $this->db->prepare("DELETE FROM anuncios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function excluirFoto($id) {
		

		$id_anuncio = 0;

		$sql = $this->db->prepare("SELECT id_anuncio FROM anuncios_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$id_anuncio = $row['id_anuncio'];
		}

		$sql = $this->db->prepare("DELETE FROM anuncios_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		return $id_anuncio;
	}










}