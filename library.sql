--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: authors; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE authors (
    id integer NOT NULL,
    author character varying
);


ALTER TABLE authors OWNER TO "Guest";

--
-- Name: authors_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE authors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE authors_id_seq OWNER TO "Guest";

--
-- Name: authors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE authors_id_seq OWNED BY authors.id;


--
-- Name: books; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE books (
    id integer NOT NULL,
    title character varying
);


ALTER TABLE books OWNER TO "Guest";

--
-- Name: books_authors; Type: TABLE; Schema: public; Owner: Guest; Tablespace: 
--

CREATE TABLE books_authors (
    id integer NOT NULL,
    book_id integer,
    author_id integer
);


ALTER TABLE books_authors OWNER TO "Guest";

--
-- Name: books_authors_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE books_authors_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE books_authors_id_seq OWNER TO "Guest";

--
-- Name: books_authors_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE books_authors_id_seq OWNED BY books_authors.id;


--
-- Name: books_id_seq; Type: SEQUENCE; Schema: public; Owner: Guest
--

CREATE SEQUENCE books_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE books_id_seq OWNER TO "Guest";

--
-- Name: books_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Guest
--

ALTER SEQUENCE books_id_seq OWNED BY books.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY authors ALTER COLUMN id SET DEFAULT nextval('authors_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY books ALTER COLUMN id SET DEFAULT nextval('books_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: Guest
--

ALTER TABLE ONLY books_authors ALTER COLUMN id SET DEFAULT nextval('books_authors_id_seq'::regclass);


--
-- Data for Name: authors; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY authors (id, author) FROM stdin;
6	Nhu Finney
7	Dummies for all
8	Java Experts
9	Dumples for instances
\.


--
-- Name: authors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('authors_id_seq', 9, true);


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY books (id, title) FROM stdin;
6	Sleepy again
7	New PHP
8	New PHP
9	New PHP
10	New PHP
11	New PHP
12	New PHP
13	New PHP
14	New PHP
15	Sleepy again
16	Java for dummies
17	Java for dummies
18	Java for dummies
\.


--
-- Data for Name: books_authors; Type: TABLE DATA; Schema: public; Owner: Guest
--

COPY books_authors (id, book_id, author_id) FROM stdin;
1	6	6
\.


--
-- Name: books_authors_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('books_authors_id_seq', 1, true);


--
-- Name: books_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Guest
--

SELECT pg_catalog.setval('books_id_seq', 18, true);


--
-- Name: authors_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY authors
    ADD CONSTRAINT authors_pkey PRIMARY KEY (id);


--
-- Name: books_authors_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY books_authors
    ADD CONSTRAINT books_authors_pkey PRIMARY KEY (id);


--
-- Name: books_pkey; Type: CONSTRAINT; Schema: public; Owner: Guest; Tablespace: 
--

ALTER TABLE ONLY books
    ADD CONSTRAINT books_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: epicodus
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM epicodus;
GRANT ALL ON SCHEMA public TO epicodus;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

