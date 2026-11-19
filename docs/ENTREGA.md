# Entrega da atividade — Streaming Music

Revisão documental: **19/11/2026**. Avaliação de segurança disponível: **04/11/2026**.

## Situação da entrega

O CRUD e a análise de sete achados já estão documentados. A entrega completa ainda depende de comprovar a implantação da ferramenta de relatórios e confirmar o ambiente que será apresentado. O relatório não declara auditoria completa das dez categorias OWASP.

| Exigência | O que existe | O que falta |
| --- | --- | --- |
| Trabalho individual ou em dupla | Enunciado permite as duas opções | Informar nome(s), turma e identificação da atividade na entrega acadêmica |
| Implantar o CRUD desenvolvido | Laravel com músicas/playlists; configuração e instruções no README; evidência HTTP da EC2 em 04/11 | Confirmar a instância/URL atuais e registrar a demonstração do CRUD |
| Implantar ferramenta de relatório de pentest | Pentest-Docs identificado; sete fichas em JSON para cadastro | Instalar em ambiente separado, cadastrar o projeto e os achados e guardar evidências da ferramenta funcionando |
| Explicar descoberta e solução das falhas | F01–F07 com reprodução, evidência, impacto, recomendação e critério de reteste | Conferir se a ferramenta contém os mesmos detalhes do relatório |
| Seguir OWASP Top 10 2025 | Categorias por achado e matriz das dez categorias | Concluir as verificações ainda parciais/não avaliadas se for necessário ampliar a análise |
| Documentar correções implementadas | Recomendações prontas; nenhuma correção aplicada nesta revisão | Se corrigir, registrar alteração e reteste com nova data; o enunciado permite apenas documentar a solução |

## Arquivos para entregar

- [Relatório Word](pentest/2026-11-04/RELATORIO.docx), [HTML para leitura/impressão](pentest/2026-11-04/RELATORIO.html) e [fonte Markdown](pentest/2026-11-04/RELATORIO.md).
- O relatório inclui **Preparação para reproduzir os ataques manualmente** e **Passo a passo manual — F01–F07**, com procedimentos locais, evidências a coletar e limpeza. Os roteiros foram documentados em 19/11; não foram executados como novo pentest.
- [Mapeamento e cobertura OWASP 2025](pentest/2026-11-04/metodologia-owasp-2025.json).
- [Fichas para cadastro no Pentest-Docs](pentest/2026-11-04/achados-pentest-docs.json).
- [Evidências originais](pentest/2026-11-04/evidencias/), [registro da revisão](pentest/2026-11-04/REVISAO-2026-11-19.md) e [manifesto SHA-256](pentest/2026-11-04/SHA256SUMS.txt).

O manifesto abrange os arquivos dentro de `pentest/2026-11-04/`; este checklist e o README ficam fora dele. Não publique credenciais reais, cookies ou dados pessoais em capturas da apresentação.

## Concluir a ferramenta de relatórios

A referência já usada no projeto é o [Pentest-Docs](https://github.com/lealvesrs/Pentest-Docs). A imagem da atividade exige uma ferramenta, mas não determina seu nome; essa escolha segue a documentação anterior deste repositório.

1. Preparar uma VM ou instância própria para a ferramenta, com banco e credenciais distintos dos usados no Streaming. Anotar domínio/URL e data da instalação.
2. Seguir o [README do mantenedor](https://github.com/lealvesrs/Pentest-Docs/blob/main/README.md) para instalar a ferramenta. Ele descreve frontend, API, PostgreSQL e implantação com HTTPS. O [Compose de servidor](https://github.com/lealvesrs/Pentest-Docs/blob/main/backend/docker-compose.server.yml) pressupõe imagens `pentest-api` e `pentest-web` previamente disponíveis; clonar e executar `up` não prepara essas imagens. O Compose também contém senha padrão de PostgreSQL: configurar uma senha própria e compatível com a API antes da primeira inicialização.
3. Configurar os valores necessários a partir do [exemplo de ambiente](https://github.com/lealvesrs/Pentest-Docs/blob/main/backend/.env.example), incluindo segredo JWT, banco e URLs. Resolver as dependências de e-mail/reCAPTCHA conforme os fluxos habilitados. A instalação não foi executada nem validada nesta revisão.
4. Criar um projeto chamado **Streaming Music — pentest 04/11/2026** e registrar que os resultados se referem àquela data. Usar a metodologia OWASP Top 10 2025 e associar cada achado à sua categoria principal.
5. Cadastrar F01–F07 com título, descrição, impacto, recomendação, detalhes/evidências, referências, severidade e estado. O JSON preparado contém as fichas; não foi confirmado um recurso de importação automática. O objeto completo do arquivo não é um payload de criação de vulnerabilidade.
6. Ao usar a API, preencher `projectId` real. Para vincular à metodologia, obter o `id` de `project_categories` retornado por `GET /api/projects/:projectId/categories` e usá-lo em `projectCategoryId`. Esse identificador é específico da instalação/projeto; não enviar `A01:2025` ou o `categoryId` global nesse campo. Essa distinção está no [tipo oficial da API](https://github.com/lealvesrs/Pentest-Docs/blob/main/backend/src/types/vulnerability.ts).
7. Anexar evidências pertinentes e exportar um relatório pela ferramenta. Manter **3 altas, 3 médias e 1 baixa** e os limites de confirmação. F06 representa inventário local afetado, com impacto condicional; não declarar exploração remota.

Para comprovar a implantação, guardar uma captura da ferramenta com URL e projeto, a lista dos sete achados com suas categorias e pelo menos uma ficha detalhada, além do arquivo exportado. Registrar também o identificador do ambiente e a data, sem segredos. O site público de demonstração do mantenedor não comprova uma implantação feita para este trabalho.

## Antes da apresentação

- [ ] Identificar integrante(s) e turma.
- [ ] Confirmar que a URL do Streaming pertence à instância pretendida e registrar sua data. O IP de 04/11 não foi consultado nesta revisão.
- [ ] Demonstrar criação, consulta, edição e exclusão com registros próprios de demonstração.
- [ ] Comprovar que a ferramenta está implantada e contém F01–F07 classificados por OWASP 2025.
- [ ] Mostrar, em cada achado, como a falha foi encontrada e a solução proposta.
- [ ] Explicar as categorias com avaliação parcial e as três não avaliadas (A08, A09 e A10).
- [ ] Se houver correções, anexar evidência de antes/depois e reteste em relatório com nova data.
- [ ] Validar os arquivos e o manifesto conforme as instruções abaixo.

Não é necessário reproduzir destruição de dados na EC2 para apresentar as provas locais. Os testes fornecidos usam SQLite em memória e confirmam o comportamento vulnerável descrito. Um resultado positivo nessa suíte não demonstra correção.

## Regenerar e conferir os documentos

Executar na raiz do repositório. O gerador usa as evidências arquivadas de 04/11; não executa testes remotos nem altera esses arquivos.

```bash
node docs/pentest/2026-11-04/repro/build-deliverables.mjs
php docs/pentest/2026-11-04/repro/render-report.php
python3 docs/pentest/2026-11-04/repro/validate-deliverables.py --write-manifest
python3 docs/pentest/2026-11-04/repro/validate-deliverables.py
```

O renderizador PHP requer as dependências Composer instaladas. Como alternativa offline, se o pacote Python `markdown` já estiver disponível:

```bash
python3 -c 'import pathlib, markdown; print(markdown.markdown(pathlib.Path("docs/pentest/2026-11-04/RELATORIO.md").read_text(), extensions=["tables", "fenced_code", "sane_lists"]))' | php docs/pentest/2026-11-04/repro/render-report.php --body-from-stdin
```

Use `--write-manifest` apenas após uma atualização documental intencional; a execução sem essa opção confere o manifesto existente. Não sobrescrever resultados de coleta ou de testes para representar uma nova avaliação: armazenar novos resultados em outra pasta datada.

Fontes externas consultadas em **19/11/2026**: documentação do mantenedor vinculada acima e [OWASP Top 10:2025](https://top10.owasp.org/2025/pt-BR/). O checklist é uma interpretação do enunciado da imagem e das evidências locais, sem confirmação de serviços externos atuais.
