--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2
-- Dumped by pg_dump version 13.2

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
-- Name: moneytable; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.moneytable (
    id integer NOT NULL,
    transaction character varying(50) NOT NULL,
    amount bigint NOT NULL,
    date date,
    category character varying(15),
    "inout" character varying(8),
    email character varying(250)
);


ALTER TABLE public.moneytable OWNER TO postgres;

--
-- Name: moneytable_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.moneytable_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.moneytable_id_seq OWNER TO postgres;

--
-- Name: moneytable_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.moneytable_id_seq OWNED BY public.moneytable.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    name character varying(250),
    email character varying(250),
    password character varying(250)
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: moneytable id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.moneytable ALTER COLUMN id SET DEFAULT nextval('public.moneytable_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: moneytable; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.moneytable (id, transaction, amount, date, category, "inout", email) FROM stdin;
3	Internet Bulan Juli	345000	2021-06-01	Housing	Outcome	admin@admin.com
6	MCD Panas Spesial	45000	2021-06-03	Food	Outcome	ronald@gmail.com
7	KRL Parung Panjang - Tanah Abang	5000	2021-06-03	Transportation	Outcome	ronald@gmail.com
8	Gaji Bulanan	1500000	2021-06-25	Miscellaneous	Income	ronald@gmail.com
9	Top Up Game Online	100000	2021-06-04	Entertainment	Outcome	ronald@gmail.com
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, name, email, password) FROM stdin;
1	Admin	admin@admin.com	21232f297a57a5a743894a0e4a801fc3
2	Ronald	ronald@gmail.com	5af0a0feb2094f43bebb50c518c1ebfe
\.


--
-- Name: moneytable_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.moneytable_id_seq', 9, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 2, true);


--
-- Name: user id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT id PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

