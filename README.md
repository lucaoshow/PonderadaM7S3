<div align="justify">

# Atividade Ponderada: Elaboração de aplicação web integrada a um banco de dados

&emsp;Este repositório tem o intuito de armazenar o conteúdo da minha entrega da atividade ponderada da semana 3 do módulo 7 de Ciência da Computação no Instituto de Tecnologia e Liderança (Inteli). A atividade consistia na execução de uma aplicação web simples em uma instância EC2 da AWS integrada a uma instância RDS também da AWS. Para isso, fiz uma página simples utilizando PHP para adicionar dados no banco de dados RDS através de uma requisição por formulário, além de também mostrar uma tabela dos dados presentes no banco abaixo do formulário, atualizada dinamicamente.

&emsp;A pasta ["src"](./src/) guarda o código utilizado na instância EC2 para criação da aplicação web simples em PHP. O deploy das instâncias na AWS e a configuração das mesmas foram feitos com base [neste tutorial](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/TUT_WebAppWithRDS.html).

&emsp;A aplicação web foi construída para armazenar dados referentes ao grupo 6 da turma 7 de Ciência da Computação do Inteli de 2024, grupo NSYNC, do qual faço parte. Os dados presentes não devem ser interpretados como referentes à *boy band* NSYNC, são apenas uma piada interna do grupo sem significado profundo.

&emsp;Importante: os valores presentes no arquivo ["dbinfo.inc"](./src/inc/dbinfo.inc) são meramente ilustrativos, alterados propositalmente para não compartilhar os dados privados das minhas instâncias criadas mas ainda assim representar o que deve ser preenchido para funcionamento do código e estabelecimento da conexão com o banco de dados.

[Link para vídeo demonstrativo do funcionamento das instâncias e da aplicação web](https://drive.google.com/file/d/1-_k0F8BnJB1Fx7bg3sfidXDEMfy5dxRl/view?usp=sharing)