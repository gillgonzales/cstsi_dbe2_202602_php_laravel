--
-- PostgreSQL database dump
--

-- Dumped from database version 12.10 (Ubuntu 12.10-1.pgdg20.04+1)
-- Dumped by pg_dump version 12.10 (Ubuntu 12.10-1.pgdg20.04+1)
-- Import command: psql -U root [db_name] < pgsql_apiprod.sql

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: descontos; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.descontos (
    id_desc integer NOT NULL,
    descricao character varying(200) NOT NULL,
    taxa numeric(10,2) DEFAULT 0.00 NOT NULL
);


ALTER TABLE public.descontos OWNER TO root;

--
-- Name: descontos_id_desc_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.descontos_id_desc_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.descontos_id_desc_seq OWNER TO root;

--
-- Name: descontos_id_desc_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.descontos_id_desc_seq OWNED BY public.descontos.id_desc;


--
-- Name: extras; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.extras (
    id_ext integer NOT NULL,
    descricao character varying(200) NOT NULL
);


ALTER TABLE public.extras OWNER TO root;

--
-- Name: extras_id_ext_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.extras_id_ext_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.extras_id_ext_seq OWNER TO root;

--
-- Name: extras_id_ext_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.extras_id_ext_seq OWNED BY public.extras.id_ext;


--
-- Name: prod_desc; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.prod_desc (
    id_prod integer NOT NULL,
    id_desc integer NOT NULL
);


ALTER TABLE public.prod_desc OWNER TO root;

--
-- Name: prod_ext; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.prod_ext (
    id_prod integer NOT NULL,
    id_ext integer NOT NULL
);


ALTER TABLE public.prod_ext OWNER TO root;

--
-- Name: produtos; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.produtos (
    id_prod integer NOT NULL,
    nome character varying(200) NOT NULL,
    descricao character varying(500) NOT NULL,
    qtd_estoque integer DEFAULT 0 NOT NULL,
    preco numeric(10,2) NOT NULL,
    importado smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.produtos OWNER TO root;

--
-- Name: produtos_id_prod_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.produtos_id_prod_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.produtos_id_prod_seq OWNER TO root;

--
-- Name: produtos_id_prod_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.produtos_id_prod_seq OWNED BY public.produtos.id_prod;


--
-- Name: descontos id_desc; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.descontos ALTER COLUMN id_desc SET DEFAULT nextval('public.descontos_id_desc_seq'::regclass);


--
-- Name: extras id_ext; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.extras ALTER COLUMN id_ext SET DEFAULT nextval('public.extras_id_ext_seq'::regclass);


--
-- Name: produtos id_prod; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.produtos ALTER COLUMN id_prod SET DEFAULT nextval('public.produtos_id_prod_seq'::regclass);


--
-- Data for Name: descontos; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.descontos (id_desc, descricao, taxa) FROM stdin;
1	esse	0.00
2	velit	0.00
3	hic	0.00
4	qui	0.00
\.


--
-- Data for Name: extras; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.extras (id_ext, descricao) FROM stdin;
1	cumque
2	accusamus
3	veniam
4	sint
\.


--
-- Data for Name: prod_desc; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.prod_desc (id_prod, id_desc) FROM stdin;
1	1
1	2
1	3
1	4
2	1
2	2
2	4
3	1
3	3
3	4
4	2
4	3
4	4
5	1
5	3
6	1
6	2
6	3
6	4
7	1
7	2
7	3
8	1
8	2
8	4
9	2
9	4
\.


--
-- Data for Name: prod_ext; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.prod_ext (id_prod, id_ext) FROM stdin;
1	2
1	3
2	2
2	3
2	4
3	1
3	2
3	3
4	3
4	4
5	1
5	2
6	2
6	3
6	4
7	2
7	3
7	4
8	2
8	4
9	1
9	2
9	4
\.


--
-- Data for Name: produtos; Type: TABLE DATA; Schema: public; Owner: root
--

COPY public.produtos (id_prod, nome, descricao, qtd_estoque, preco, importado) FROM stdin;
1	fkor	Dolore et magni a quae et cupiditate ut.	4	2631100.97	0
2	eooj	Aperiam est qui cupiditate inventore.	5	0.85	0
3	kgoy	Aut ut dolores est eos ut officia sit quod.	1	54558458.10	1
4	sddq	Aliquam qui odio sunt repellendus quis dolorem.	2	37105234.89	1
5	lnml	Et a ad molestiae ab explicabo ullam modi.	5	58694897.12	1
6	uenm	Reprehenderit voluptas voluptate reprehenderit aspernatur.	8	1.11	0
7	efsd	Ut qui sit rerum blanditiis illo.	5	77824.48	1
8	hjbw	Et eos neque recusandae repellat consequatur molestiae mollitia.	5	6596.76	0
9	fbtk	Eos numquam quibusdam ullam dicta rerum.	8	472898.85	0
10	polt	Fuga quis ratione facere.	6	66516.80	1
11	eutp	Tempora cupiditate aut quos itaque quo deserunt beatae.	2	625.00	1
12	elhc	Impedit nulla neque itaque vitae.	4	41.37	1
13	nubm	Laudantium mollitia quia omnis minima.	7	0.79	1
14	eykk	Qui nemo odit ut et sapiente culpa.	9	0.00	1
15	kqem	Voluptatem ducimus assumenda ab explicabo accusantium.	6	829.26	1
16	reob	Quisquam neque similique consequatur molestiae sed.	9	2863.69	0
17	mgoa	Ut et qui accusamus possimus ipsa cum.	8	647.50	0
18	ujju	Vitae dolorum nihil magnam neque.	2	1693.84	0
19	dpyp	Earum maxime eum temporibus quas dolor.	4	0.00	0
20	oyye	Nesciunt doloribus quia tenetur omnis.	7	0.77	1
21	xcfz	Non corporis fuga nihil quae aliquam modi et doloremque.	4	99999999.99	0
22	aigm	Saepe corporis qui eligendi nulla qui non ab.	3	99999999.99	1
23	asfd	Mollitia et nihil nulla et eveniet quia.	9	49628.92	1
24	iiyn	Ea perferendis occaecati qui vero magnam qui.	4	23378339.00	0
25	nche	Voluptatibus perferendis vel corporis.	5	6.00	1
26	zxao	Omnis doloribus temporibus fugiat.	4	249.00	1
27	elgg	Architecto doloribus aut quis hic.	6	2.14	1
28	nxci	Autem magni laboriosam modi.	1	7.36	1
29	yifm	Dignissimos laudantium ab voluptatem similique veniam et dolorem.	9	27332.69	0
30	labl	Nulla voluptates dolores repellendus rerum voluptatum vero sit.	4	85.48	1
31	zicp	Nihil vitae voluptas esse eligendi accusamus.	9	4.43	0
32	lpsj	Sapiente nulla voluptas nisi quia veniam commodi.	7	480947.60	0
33	kgqr	Reprehenderit asperiores quidem eaque delectus quo tempora et.	8	0.00	1
34	ipdc	Quis facere mollitia fugit culpa dicta.	8	37919823.09	0
35	gtpf	Eligendi rerum ex repellat nihil omnis quasi.	4	0.44	0
36	hmbh	Beatae tenetur officiis et enim modi ducimus non sunt.	6	99999999.99	1
37	xpad	Numquam fugit quo ipsam explicabo aut molestiae id corrupti.	7	55.98	0
38	ybbx	Fugiat dolorum minus exercitationem sint.	3	1141.60	1
39	igcb	Tempore beatae porro ullam qui corrupti.	6	478224.91	0
40	jhgp	Minus dolorem ratione dolores debitis illo ut necessitatibus molestias.	7	0.00	0
41	ohff	Delectus molestiae veniam quam aut eum.	1	2.85	0
42	lqzu	Atque qui sapiente dolor modi.	4	45459.49	1
43	btbu	Nam vero quisquam explicabo cumque tempora enim nam.	5	12376765.00	1
44	osis	Consequatur aut molestiae nobis similique.	1	343616.00	1
45	adtd	Possimus iste repudiandae accusantium quam iusto exercitationem.	9	5284738.69	0
46	mjxa	Id adipisci nam saepe magnam explicabo nam.	4	55722972.80	0
47	htbl	Minima eius quia odio architecto labore porro culpa.	9	481.79	1
48	jkpw	Doloremque non ut pariatur sint alias aut accusamus.	9	625739.24	1
49	ajmo	Error magnam quaerat eligendi quis nobis possimus autem.	9	99999999.99	0
50	mwyl	Quia ipsam quis non nemo et delectus.	3	5034925.86	0
51	xldc	Provident praesentium eos qui aperiam nemo repellat.	2	43177801.88	1
52	axeh	Illo voluptatem dolor deleniti laborum sunt ea temporibus.	2	847771.44	1
53	jpdi	Et sed ea officiis ab.	1	10056.20	1
54	rwyx	Quam ut cupiditate sit amet sed.	1	3292.28	1
55	uvoq	Dicta voluptatem et tempora totam.	1	0.74	1
56	gljf	Aspernatur officia voluptatem ratione laudantium.	4	6126.46	1
57	yffa	Tempore voluptatibus neque quia nemo.	4	23085.40	0
58	grjg	Officia et dolores aspernatur rerum cumque ut dolore sequi.	7	117.57	1
59	kzkp	Sit et ut asperiores consequuntur necessitatibus et.	6	341.96	0
60	iuwv	Rerum est officia dolorem molestiae.	7	2.10	0
61	zpaf	Dolores praesentium quos natus molestiae nam aut eos.	2	29009.08	1
62	kdpv	Vel qui et dolorem.	1	13356572.61	0
63	pzbz	Praesentium et tenetur quia expedita voluptate odit.	5	1313.24	1
64	nsqy	Amet hic voluptatibus aut impedit et.	1	10815481.57	0
65	klfj	Qui qui placeat ut laborum et ut excepturi voluptatibus.	5	1167.68	1
66	dbow	Non iste ullam veniam nostrum impedit at delectus.	9	39693163.77	1
67	ssmh	Qui veniam sed sit vel harum.	7	5.09	1
68	bhmz	Sit corporis natus id doloremque reprehenderit sequi.	3	298.48	1
69	tzvx	Atque provident expedita qui vero ipsa.	4	4292.55	0
70	hmzm	Optio vero quo rerum.	3	399545.12	1
71	dazy	Et quaerat quam voluptas sit accusantium rem asperiores eligendi.	5	0.00	0
72	avyu	Sit nesciunt amet amet ut.	1	99999999.99	0
73	ijru	Vel consequuntur est et odit accusamus.	8	32809249.41	1
74	cfcf	Ratione nemo dolores delectus labore.	6	107732.22	1
75	ehtl	Illo dolor optio ut doloribus aperiam illum.	8	243.07	0
76	mgnh	Velit magnam quo enim quibusdam deserunt.	3	14535490.48	1
77	payc	Eos veritatis id tempora incidunt quidem nesciunt.	4	465935.29	1
78	tjsy	Molestiae minima vitae aut autem.	9	7154652.90	0
79	hjna	Mollitia ratione voluptas ut qui atque.	8	11266.57	1
80	esxe	Eveniet totam minima excepturi consequatur blanditiis.	7	99999999.99	1
81	qfmo	Repellat facere et sed magni facilis ducimus modi.	3	1.34	0
82	oxoj	Quo facilis distinctio nostrum blanditiis.	9	37538423.18	0
83	ytgu	Dolor dolorum saepe alias vero.	2	0.00	0
84	nwoe	Totam nesciunt dignissimos libero rerum nihil quo id.	8	0.00	0
85	apgr	Libero deleniti hic distinctio et.	9	0.00	0
86	bacd	Sunt fugiat cupiditate dolorum voluptatem provident velit ut optio.	6	207825.00	1
87	mqix	Delectus sunt quo eius a.	1	0.00	0
88	qxht	Itaque consequatur alias sunt et.	7	86255.98	1
89	itgy	Laboriosam expedita sint iste voluptatibus.	6	20316.56	0
90	anqg	Enim totam est aut qui.	9	21.35	1
91	fcst	Aspernatur molestiae et dignissimos debitis quas et tempora.	6	470033.50	0
92	iptk	Tempora quia suscipit quibusdam molestias voluptas nostrum.	8	2257.03	1
93	sztx	Qui est ipsum repudiandae est enim magnam consequatur.	2	2471424.07	1
94	agmz	Qui et et dolor sapiente.	9	30072.39	0
95	fiwo	Animi modi sapiente sed ducimus.	6	36568727.99	1
96	tybg	Delectus fugiat dolorem aut quidem aut laboriosam.	6	0.00	0
97	rusg	Error ab incidunt quasi culpa quidem nulla iste.	7	4830.01	0
98	oxjx	Qui ad minima aliquam quam praesentium debitis.	6	105.85	1
99	cfmm	Rem ab omnis et saepe quae illo illo.	9	3584177.00	0
100	uwtd	Dolores molestiae quis similique numquam autem.	5	7.69	1
\.


--
-- Name: descontos_id_desc_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.descontos_id_desc_seq', 5, true);


--
-- Name: extras_id_ext_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.extras_id_ext_seq', 5, true);


--
-- Name: produtos_id_prod_seq; Type: SEQUENCE SET; Schema: public; Owner: root
--

SELECT pg_catalog.setval('public.produtos_id_prod_seq', 101, true);


--
-- Name: descontos descontos_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.descontos
    ADD CONSTRAINT descontos_pkey PRIMARY KEY (id_desc);


--
-- Name: extras extras_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.extras
    ADD CONSTRAINT extras_pkey PRIMARY KEY (id_ext);


--
-- Name: prod_desc prod_desc_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.prod_desc
    ADD CONSTRAINT prod_desc_pkey PRIMARY KEY (id_prod, id_desc);


--
-- Name: prod_ext prod_ext_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.prod_ext
    ADD CONSTRAINT prod_ext_pkey PRIMARY KEY (id_prod, id_ext);


--
-- Name: produtos produtos_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT produtos_pkey PRIMARY KEY (id_prod);


--
-- Name: prod_desc prod_desc_id_desc_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.prod_desc
    ADD CONSTRAINT prod_desc_id_desc_fkey FOREIGN KEY (id_desc) REFERENCES public.descontos(id_desc) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: prod_desc prod_desc_id_prod_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.prod_desc
    ADD CONSTRAINT prod_desc_id_prod_fkey FOREIGN KEY (id_prod) REFERENCES public.produtos(id_prod) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: prod_ext prod_ext_id_ext_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.prod_ext
    ADD CONSTRAINT prod_ext_id_ext_fkey FOREIGN KEY (id_ext) REFERENCES public.extras(id_ext) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: prod_ext prod_ext_id_prod_fkey; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.prod_ext
    ADD CONSTRAINT prod_ext_id_prod_fkey FOREIGN KEY (id_prod) REFERENCES public.produtos(id_prod) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

