<?php
	$tipo = $_POST["tipo"];

	res = $variaveis['faturas'] = $this->m_cartao->faturas($tipo);

	$xml.= "<faturas>\n";
	while($row = mysql_fetch_array($res))
	{
		$id_fatura =  $row["id_fatura"];
		$nome = $row["nome"];

		$xml.="<faturas>\n";
		$xml.="<id_fatura>".$id_fatura."</id_fatura>\n";
		$xml.="<nome>".$nome."</nome>\n";
		$xml.="</faturas>\n";

	}
	$xml.="</faturas>\n";
	Header("Content-type: application/xml; charset=iso-8859-1");

	echo $xml;

?>
