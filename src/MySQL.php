<?php

namespace CauaAuler\Tinder;

require_once __DIR__."\Configuracao.php";

class MySQL{
	
	private $connection;
	
	public function __construct(){
		$this->connection = new \mysqli(HOST,USUARIO,SENHA,BANCO);
		$this->connection->set_charset("utf8");
	}

	public function executa(string $sql, array $params = []): bool
	{
		$stmt = $this->connection->prepare($sql);
		if (!$stmt) {
			throw new \Exception("Erro ao preparar consulta: " . $this->connection->error);
		}

		if (!empty($params)) {
			$tipos = str_repeat("s", count($params)); // Assumindo que todos os parâmetros são strings
			$stmt->bind_param($tipos, ...$params);
		}

		$resultado = $stmt->execute();
		if (!$resultado) {
			throw new \Exception("Erro ao executar consulta: " . $stmt->error);
		}

		return $resultado;
	}

	public function consulta(string $sql, array $params = []): array
	{
		$stmt = $this->connection->prepare($sql);
		if (!$stmt) {
			throw new \Exception("Erro ao preparar consulta: " . $this->connection->error);
		}

		if (!empty($params)) {
			$tipos = str_repeat("s", count($params));
			$stmt->bind_param($tipos, ...$params);
		}

		$stmt->execute();
		$resultado = $stmt->get_result();

		if (!$resultado) {
			throw new \Exception("Erro ao obter resultados: " . $stmt->error);
		}

		return $resultado->fetch_all(MYSQLI_ASSOC);
	}
	}
?>