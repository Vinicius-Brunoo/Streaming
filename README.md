# Streaming Music

Projeto CRUD Laravel para a atividade **T2 - Projeto CRUD Laravel**.

Tema implementado: **Sistema de Streaming de Musica**, com cadastro de musicas e playlists relacionadas.

## Requisitos atendidos

- Laravel com rotas, controllers, models, migrations e views Blade.
- Tabela principal `musicas` com `titulo`, `artista`, `album`, `genero`, `duracao` e `capa`.
- Tabela secundaria `playlists` com `nome_playlist`, `musica_id`, `usuario`, `data_criacao`, `descricao` e `status`.
- Relacionamento obrigatório: uma playlist pertence a uma musica.
- CRUD completo para musicas e playlists.
- Upload de imagem para capa da musica.
- Campo de categoria/status: `genero` em musicas e `status` em playlists.
- Autenticacao Laravel feita com `Auth`, `Hash` e model `User`.
- Visitantes podem listar e consultar; criar, editar e excluir exige login.
- Layout proprio com Bootstrap e CSS customizado.

## Configuracao com Docker

O projeto ja vem configurado para usar MySQL via Docker na porta `3307`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=streaming
DB_USERNAME=root
DB_PASSWORD=streaming_secret
```

Suba o banco:

```bash
docker compose up -d
```

Depois rode:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Se preferir usar um MySQL local, altere `DB_PORT`, `DB_USERNAME` e `DB_PASSWORD` no `.env`.

## Deploy no AWS Learner Lab (EC2)

O arquivo `docker-compose.prod.yml` publica a aplicacao na porta 80 e mantem o
MySQL e os uploads em volumes persistentes.

Na instancia Amazon Linux 2023, instale Docker, Git e o plugin Compose:

```bash
sudo dnf update -y
sudo dnf install -y docker git
sudo systemctl enable --now docker
sudo mkdir -p /usr/local/lib/docker/cli-plugins
sudo curl -SL https://github.com/docker/compose/releases/download/v5.6.0/docker-compose-linux-x86_64 -o /usr/local/lib/docker/cli-plugins/docker-compose
sudo chmod +x /usr/local/lib/docker/cli-plugins/docker-compose
sudo docker compose version
```

Depois clone o repositorio e suba a aplicacao:

```bash
git clone https://github.com/Vinicius-Brunoo/Streaming.git
cd Streaming
sudo docker compose -f docker-compose.prod.yml up -d --build
```

Acesse `http://IP_PUBLICO_DA_EC2`. O Security Group da instancia precisa liberar
TCP 80 (HTTP). Nao libere a porta 3306: o MySQL fica acessivel somente pela rede
interna do Docker.

Para conferir o deploy:

```bash
sudo docker compose -f docker-compose.prod.yml ps
sudo docker compose -f docker-compose.prod.yml logs --tail=100 app
```

Para aplicar uma atualizacao enviada ao GitHub:

```bash
git pull
sudo docker compose -f docker-compose.prod.yml up -d --build
```

As senhas padrao do banco servem apenas para o laboratorio. Para troca-las,
defina `DB_PASSWORD` e `MYSQL_ROOT_PASSWORD` em um arquivo `.env` na EC2 antes de
subir os containers.

## Usuario de teste

O seeder cria um usuario administrador:

- E-mail: `admin@streaming.test`
- Senha: `123456`

## Observacoes para apresentacao

O projeto segue a proposta das aulas e do curso do Matheus Battisti como referencia de CRUD Laravel, mas usa identidade visual propria para cumprir o criterio de layout original.
