-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2019 a las 04:11:40
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sipa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_10_01_210150_create_sipa_opciones_menus_table', 1),
(5, '2019_10_01_210157_create_sipa_roles_table', 1),
(6, '2019_10_01_210314_create_sipa_permisos_roles_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_activos`
--

CREATE TABLE `sipa_activos` (
  `sipa_activos_id` int(11) NOT NULL,
  `sipa_activos_codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_usuario_creador` bigint(20) UNSIGNED DEFAULT NULL,
  `sipa_activos_usuario_actualizacion` bigint(20) UNSIGNED DEFAULT NULL,
  `sipa_activos_precio` double DEFAULT NULL,
  `sipa_activos_estado` int(11) NOT NULL,
  `sipa_activos_foto` blob DEFAULT NULL,
  `tipo_imagen` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_edificio` int(11) NOT NULL,
  `sipa_activos_ubicacion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_encargado` bigint(20) UNSIGNED NOT NULL,
  `sipa_activos_responsable` bigint(20) UNSIGNED NOT NULL,
  `sipa_activos_marca` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_modelo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_serie` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_disponible` tinyint(1) DEFAULT 1,
  `sipa_activos_motivo_baja` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT 'No se ha dado de baja',
  `sipa_activos_fomulario` longblob DEFAULT NULL,
  `tipo_form` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sipa_activos`
--

INSERT INTO `sipa_activos` (`sipa_activos_id`, `sipa_activos_codigo`, `sipa_activos_nombre`, `sipa_activos_descripcion`, `sipa_activos_usuario_creador`, `sipa_activos_usuario_actualizacion`, `sipa_activos_precio`, `sipa_activos_estado`, `sipa_activos_foto`, `tipo_imagen`, `sipa_activos_edificio`, `sipa_activos_ubicacion`, `sipa_activos_encargado`, `sipa_activos_responsable`, `sipa_activos_marca`, `sipa_activos_modelo`, `sipa_activos_serie`, `created_at`, `updated_at`, `estado`, `sipa_activos_disponible`, `sipa_activos_motivo_baja`, `sipa_activos_fomulario`, `tipo_form`) VALUES
(1, 'fd123', 'yo', 'fhg', 1, 2, 122, 0, NULL, NULL, 1, 'dfgh', 4, 8, 'fe', 'cds', '11', NULL, '2019-10-22 07:03:39', 'Nuevo Estado', 0, 'sdfghjk', NULL, ''),
(2, 'fio', 'fiorella', 'fiorella', 1, NULL, 30000, 1, 0x6956424f5277304b47676f414141414e5355684555674141414641414141426143415941414146596a6546644141414141584e535230494172733463365141414855424a524546556541484e585175515a56563176666431392b73654742514a52637234515532423053706a596b56445569626d5578566a42426e354f6f434d435554797159414b6f7649542b5967774444417a444d4e6e45426845694d5445714768694b706f5046596d784a4d5355566b6b704b6c4947593471536d6536656d65352b4e327574766663353539352b33644d394d347963376e66504f667673766662612b357837376e3233333779707169466c3754756d507430563136566738306d543233614e565374336a6c625672744736326a6b32386f484c6278372f4348576b32467a61394f37342b7554637a68456f6a454542536a4f7161644372506e4c6a65463366643879324b326272356b4968514d45554862486f3936716d4f6b377536354a465864586f5534536a666e714a59394f6b356e76765846453136464f456f3335413230734c45556774784b6f61696f6a307a45507367634333684e6c43484d4c78625a3835614258635043784351594f73436f35563366764e4d74527138306e626d3234654c3774355255736e596246787a5a724a6e494c57534e4835784363617a4d2f38306f4b39635456636334343549336839384c6273566f7033726472576142447a7534734c67764d386b71667a32673054645833763055396e6c4c46696a6f74354a6e704f7547675a6b315a4b4b5965676f326a4246744e755555485155647976694b732f2b3577696c384d35626c6a5862386433342b704a7043726e7355793452565563727a7439367674582f64474f647859694e51753333534872727a393173706c4662755a36645458414b706974657a7375756e3169785842745036334c7754755033336232544b396550777458637754436c424e737474656f746a36426261782f32506a59705a665773344568686c77574d6f5968363243556a46734d71515077354d67643033616b3931447676714f33665350516f2b594a72654a4c677875463967464f4270735935314475687637674b50696558336961716a67774e35517a72353751506951556a48504933414334304d2f62546f46624d6a7a375977656d6b666664626e4e7832566b37466d445956454d4235564555366d72446156504b36587532486c4264666359304a674f386b4d4d614f57737864503268495a634d53592b6d746765717330674f6366613937624d4876544c46354930794a78517868344c4e6c42624d4956566135615048625775344a4a6136446765392b7075342f4352533877424c394a744f6e54357470687263486576537a705336756e444c5241397038615651576979787657374e3150713166376a7a324b576f4c38707734796d546c34486478514f6d674763517450754872466a35336d76727959584168774a2b37692b6138652f2b3739514f584a47784952434d703555424276694862736c3766776b2b4433444c385459703268414179416c433471745a422b53356e707a3036716575326a522b79464441753164746578496848525937444d4f54496572594a4e4c474153647a4c6d63716d7448656d64646533372b647750556e6a3574363463365a756365544d6854535468494d69787a617673676468796e775859634f454d554e3132484c357462563042764453754634663545634b6731307a7677364354704155305374776a47644a5336786379514e61787a2b6465365946426f55754d5142375937484646784e577851306f553951486d526e5466516c54575071596f4e49444733764d4441657555485972734d324251364d686e346f70464d706d7a37376953486c4c476d6e7361344d6e49795045396a5964547870335064442b5a484163706a373539783967454e6264666b665434756851304c49584644664a413459506a4d5167626d4a336f414e746c79486a456d6d6f6f32303041384f366b4c2f325a2f44784a444d575a3656362f42524c724a39735137726c57505054644e363937486264464d552b35334f37575763792b76576a77737241544a2f57342f662f735a6456664e33383359626268784439384f71756d72545241756a3153456f7936306e5458356e706d35657575682b4f4e49372f6f716278762f614c504a784b47414d6238417450396c47476e7a5466654c69323161384d48533639614b41564f5a62776e58666d5a376a4e65563964787977572f33644b6e515a444f7666634e726b77334e563955734e5430756331774f67386a55794f765a623539383239732f44624a597132794f43743534362b64715a51665756494d4972534c525a6b3253446854484170734572426366782b76496c74363734396155534337306c45377a74784f332f434f652f497a4b77447364427a45676147534e704f69515a5757574742386f774e73615233693965667550343134504951765743424f3835667363527577597a3377706e7967693055372b597970445275524646787068426e72634d68686e30544c4a6436716e66717a2b7a64735034573461526242473839356874392b48323475546b424b4f3833636839547030354e464b63527651705139316467326d61505774474d712f526a477559796a53772b76332b3456646658582b666845575164794c735a414f41464534314c5a3270696d6b7a6f706c3045452f6b496e50417a35684670734567706a30794730734239623138552f597779655543592f7a77463447727471736a327569485442473555573458657a36767146526d3751714573317549624745744f77726254515464564b7552703272632f61524b4635593274674f374c347a523261496c496f4753416b34474a4a4d36676e4236426f364f54475658506f4b53616e476759746e3154495173626c6f694f376f46695137424a5168747a41723669516a4843327a5463676b364d6a5841754b5570744d4f556968426232734f5247314d653944484530596a36504479785939465530676b474f42623663554d53694662625552544e4a414679696a746c37395a67416e4e7965374d475358766f32336847797a4f61506c697a3645596274614b456a474b326a7a70684c4d6b3042746e7233777059704b3342506b6a5a6c2f34576a313469785a49344b4d5a597a413479423669524e6a6235476b71515268784e6d4f7871546468306d544750646658512f5867585857784a52783037566a33344e374e70632b6156524752687a36324a4e6979306a6b4b4a685949576675584b37595a4d735a745345596147535167725a6b77636c3646694b344c68387732575a2b3061544d515a43566d7a7a6a45623852416745427579597951344a32474262555a4f3274674f374943654e6156716f594f3868587655544c4d4b5a616d544a4a4a78694b6f2b7a47367647683037526c72644178554c6d645a67495974644c5a4a68555250535371785a362b3370506c6a484f5670563937356c323655412f5742635338754676372b76785657766e7636466c3438393936797a36706b7953524638396246546d2b664d5455332b474e7645574e777569586a72776d3962456555576c463330387730486277353474324e6e72396e6e473450757a556254363631627537352f58694c686a614545753071336e3742744d374c344a79575a3073465167695333365031675058646733662f5a437a62562f396631562f6158524c4130754f5730796563505a71736e3572413852424b443558496f696164624c7178366b71314736363258626c3678707354625858765a424c75416547423850366278684d69755a52505437394e62392b75586675446d46642f7432693231763963457739463165486736614f624f774270383750413372586a5053536656654b4f3339325776435735342b2f51625a70764250396e74504e3469634e2f68796454722f65663762352f343562326c754d6345743736394f66416e672b6b667a3157444355306e6b4f4b57506162627a756a36386f7533724c686b54346e754563464e7179662f4465767531375465744e5a7741574457524a4a453765554531612f48526c3533795533392f31677530575552764f586b37652f487772714b6a6e573238693547626454776e44504a635936315356636a766532486a5059505058746a76584f70524a6445384934546437357170707235723054477a3144327564346959304753355068326c6633574f47514b6271542b346857624a6e35334b53547059734879705575623063662b652f75506b4c586e64666333586e566a2f784e785a5a4e58446854507243365276476e565068685a7a5a6d756537317a72747a5933374167415177735350444f34375a2f47744448644a326b4c436f6250467435356e706d6644324b6547544c79566b514441425047397957656b612b4f584c7468676b3871707866356847385a39586b4754677a742b676171756d7a4b625231783357565837486d687132336372724452767267594833626a717a4e514f73667254783437506e343036776d4961676d67703834636672464d7a746e76786645744936675a5352736d69526a3943427534354237316b715a725473475a6e61344c437054707573324444547765554f685a454457712f38536633683557347667666363382f5758637a78326c614e78355247317279724a496d57584c737544546b3845375a3631306777514a7954375053506749636f47746572542f6f6f335831442f6f3459485278306c4f7178454f56486747734b436d4350465a76334f556e4b51306e47373232316f6364346d68737863537633734767487557706b626e646a334f6a7636457859624d4e4631774331426277446c715468505a78744f7530456c5a4a555a4d45345043713773507868524c7268504538485569676b48594a3975522b6b716f57564545544156494b427730497a4d6b7a2f78597a5137622b436b6a4a796b7a4350505564786570547864554458794e5535674b32384a2f63794b6f4d636c4a417758742f43544b5a524248693454315a6a34356f6b314d7438787450466d596a4e4173354750325241785544666d422b4e5634496d67715a496953394e6c776d516238674e4435773938554f4e75755453752b65475167716269794d67304659746a373536536868724135437031454d446c6967356957663763304a7a78614b34744a524c594245417069474233585632556f4971632b4647466261724a4e3936775451656e79344d52692b6b777562327161333568656b356578784c70555a704146467375496d756f70427a69594857695541464a7a6646686d677353696f6d6443304c4c4e3030515a6f364b65455446774d326d71643378347646707a3259526f42616d6b4a7a4e4445423835494251614a457663564e6a6a717934654874477a6b2f4d783666424a45363875546731314c694a4263413358316347485952756179654e7146633770496f6748486c307169454b506346614b444d6f4a70616d522b584b46454e67636d436c6c4e6f32755639685267376f3873725932473946437a642f555a5a435a6c6f6e6c49552b78684653694654746f6d6f326c6e2b71456b4a36694257556f714139356269547a6c6c4f7142416d36494862676379797a56516348707154374f535152797952316f6f6857474e484d43676d2f2b6f326a3152744f373776457168453863547a2f6f2f6e4461413973335656393755473751524638324c4d4470674f795a4c754d5544727741486c3667476d4f4859496447555844526d5848413042354f587279322f69443361646d524a7239587a316d744271417937392f666a624a6e76782b59557550474c464d596b5a772b625464416a72795a7836594f525a2b6a435152564e6f705a554d344e416f7271336e5545505651535043483338457042434776703639393836684f6b6e2f6c4531614d3839724b73644a3564456a436c6f33354b58485a486a6a6e764d31417147494c77794e4c776d685962434354497365496d3567356a754b6b344477546e684544596461676734505a6f564d43534d6e78595a634a456f754b416b615469724b31534e6d6c6a4d36705a796549675a754a4c44544f5670366d776c35456e4a69704334632b7655743046454f67747a5446516e5a7969516e306c724d50336e446d447432555768546d716e544f34494b34683670384b4e69435a435a625a44426c4f5455416f58515269684579457859625856504761564a6241786e577875334949644e694931716f2b5a75367a4771324e37453835436d576b4571305967644e7337483047306b626f67344a327a535443417073776f6d6270373470464f50537a66686d5436736f686b41666551317954484b504247334c455073754b3171525151615267696678624335374f6f6e536f754434466c5457435632536f6639453046516349756d7a55634b364f566a494d59615a634257323065434c566e7a787945425363575752676749786c415254546d6f57464936514a344c4a45527679556c715a4578367435566a6f554575324152414b4d6f394f38753049746b5273464971774c54585a4e6e4c3174374356387431515558794f474a6b33715a34557a4b2b6c50395a6331694f776e55783565644136323750485744492b4f69574150426b2b4c6e546e3970377a334a55485330594d4b6e6f6d6a416846655a6f6f553653514a546e4854536761636b776f4a35583042473849644f5044776947412f454673685a6a4e6f78765831742f752f63453939644e482f4e78426658782b44702b2b6b36646b5443754b776c6d5952793035775958656e7162514b5a30626573454f536e4c4a494a4d425a4c33715178757548542b536f6c4a653358767339472f4d4e6a502f4575393537526f4c676b445a482b2b4c38667a773458585839313954634730546a49477471375a6669317541632f576d334e2b4d5a374b346b464f4776484b38396677503362684257505435494f786254385471657562415138594f78594f6a70344e44314b304d686a427150494c37426a4c33436e7436594d3955676a516e616d2b664432716d526e712f662f5836736238506e39313655594a5576757630356d646d70696566784f3354434d6b5a326169782f724252746249426d36553848385469752f6e4b6d79622b7445756f3239387477544334376553703477624e344a4e424d6a4b5a43594f7342794164474d5a306834302f65336e73387330544c7776633364564c4a6868414e35303865526579646a724a38473869636c715169622b54364947515078653045367a586a4234772f6f494c6236682f4746684c715a644e6b4b4459322b704e703077396a737938514138702f5554535536736969386f6f39556448336e374a4c654d665777716872733465455179517a652b5966736e4f3263466a356531395443647258456a2f366f4974423577592b6e745337785842634c682b7a6551375a7766564c6237477547382b6676376845792b704f382b62513338353954346875427948432b6e797336306248747435356c7a54584e51306778647865584162536c63724d613278724f6f7233762f693853333749766946754378482f6c4e4e3449316e5442382b324e6d737855564a7935524c6d5a633258617937436352516c6e754964652f2b2f6b547a33764d3272666965532f5a3774563854794d3370706c4e336e494956646a56573241753079686779574f546b3261704c717738626d4336714f6b49786446326556326a7a524430793872344c4e2f632f6a68732b6d757958386f776e6b4a2f4161476172442b4d357868702b42694e575564776b38705a4962544252314b7a3931493036644350687245326d394f6e3679737a715578753675367778566656645979763646797a33737258637244386a436478793075537175615a61683353394c4a4b694b30305265456f4b30715a454d58466b7a2b537037664a494d4959306a6a736e506c54537164354a64435257713952313642667646504234717a37336973336a6e304a336e355a396b6b44654c7337756d4c71734754526e4959675272537045595147567036636c49524c475343785a6149424a506f3164546e5a496b6a33666a4d53614c764d6a57302b693944724a4e7639323435386e4447396336757157412b767853336233675365343247335a3477546565634c323378734d6d6873517943754d48466f4d466b45774f4d6e38546a44474c55486330307958656b713237326552524c4f335a42754f74536c50435a644e3661756a673867536a69665a2b74324531742f4568784c65395a474e59313867376557574a5365516e39567270695976426f6d7a45585266776441626965715645314f75774169695846313643326870744551444a69556d677655454446744637596b793235445a5a4256347847617938616262566a34597951666b48622b495a5266654a6d7734384f442b35635065576b4a39586c6b306752392f36394f7648387a573637475876535935395655567a6f6e59436836497256586f3432616656347a7574417662534a52776d647a4f704951506a6d7653777459545471485a65474a634c79614f2f746e575a57786f416a6e6d47456f326c4875397232482f50476664757245484354657374424c343158633259342f2b7a2f594c776639384a4746464544586e4f666955504366664456616b345332434a6f36526839427456444e4a726b647945577a49464241317567453736395a34675356374172706638355835683538385468354d486e56513834632b77712b31703646317a53746533722b5348366b6c5041754871732f6839507a4a54375a394663306a32436542444a34425463342b437136477249314d3641414f767a71466930517065625442324c4367737939695a6979463750746a6241744a312b585367612f6b6b7a3763563473625a4a47552b62725a5876683853416438586279536e32795042366d504e69763776374952543544712b3162742b506c7164755a527a7a6c64352b53683258576141754874424d64646e3757316b51415049756f5564434750325a3066444831326b6c697342506b426a746b72666359525475492b4d484d78547130396b43794a56334178336e6b78444f50623171462f66703344364245392f4d56765853743554416752696b7247364c636634535974307731394e38334333444953625956324c30437954617346414d547557534661574676435131633633704850704971594e526d534a6e50714a35554173655751656d787759644a65625533423744702b793541652f30727142795a4b5252585265574c5a6a35307957567434387534734d475472776e51534f517a4c7462415a7342636e7044474a4d424c2b6f6157416f303858474859546145664839414979314f6b6a4a3477653442654435514e30536f584a4d5165772b4a3252464877413754514749357739522b4a45484636796e5163424e535a477a7030334859717373755236464151545756675139434b786f69654f465245694d58514645336f63706843766d4855446743695570654f6330413575464363484d444a374138734a68513545784c494a4b665745594d6e53754c4d74644e306f2f2b334c544e7248434e4c686369414d4747414b546f4f477241535454544b6b49765577516858716f6846424a483371324a43536b4d77704534445850694237783554644542334b56527a62564f7855743454364f436c4b7878717473515268494437336b495a5239382b766273444b514e6c673232645a4f41596d565139493764425268325a5a6a3630574d51335a6c754471716c6f366c4e6a5347444a47506a34634f73417354303236703435636b56766f43573359675162354e4b596c62534b4f73426465596237674b57774d6f516b57415752674544684b693344686a45626c6d414a4245444a7a5063726b772b7651536543556c34584737746372434d6a464a3165417055485a6a6b53594c6b7855514b576f785344357342474c684730754974705a497456516a506b7a486d48684e6548737151656379374b74514f644d695846687830424e4b396f3269376f667734425462414f356e4471474756703139653474452f6a694137792f6d6d3671362f384d39374769624b35346e3159573435686c78444a4d5478364a706d48723847676c456f78706830346b4b7534445179766235316947726b414c4a50785a456767534b7a45414d77467630544e2b74666f6b597649447836306f69494a6d7a4378464e6b5144526c726f6f53644d426b66465669496f383556563243532f616f53424c595a306472674c63704248314b627576434d5239496b534f74597a4c6b4d546d42693633776a46484a6c516a6749706167363554596a4b326f4a764b375237314a347653526741534c6b6c676151624b38673070654e4738706c55625448456552506d6b6165325a316b6d31327845637458476766704454324537485768424c616a424d6a6252654f654145525566316c73663830437a78466a6d63587253774c415a634655642f4878383139584c5274516d6d364373476e312b5249796c68793952656556523041736431437a556f2b774a5043353936736335696371746a354e33657664456d6363537667696c542f306c50644f786d63496746616a4d47712f677a316a356a6d6c6f41714571666475374c486c734d7a46632f69526f6e33386a494a57467243527233776941734d413462555761756d67523538577647716e65734b623959564b616473746f7636364f506d7468765165327a6c525050546958754b466841516a492b4c74333479676d354b786678614c596e47663456374b49476e4b505731694b593445564741415761765343435072307257783437736a456e53526e4d6a4f5370456c312b74514b3442743153423735776b7a3179442f6b4437594b306e47347374364672795673585551305a6b43304e333167516a663879346c382b30474f305859434f56452b4c6b356f477a6b6b6b777445794b3451374a4e4b627342326754325167626f3961675774724645574132695365425159704d305a4d6739506f3753494c53414a704630436448536b6d413874653644546b6a476e684d464a365a38304f5379323543626c6a44652f52514f654b564669775a676b37504f343653325951474d494a6243674d524e695359484155567145586364674f554c3630594d4a6770435a36326b305646437a615450667065676746507451316f425654467867755871374d76344549432b597149424b55597442386d456a3547564b3467383753365161476c737767594b54497a70306a34474b32707837557568454f755a4d4c4e546b4c475a4f4d56724171456b355052686d61455674326f576e55746b4761642f6847483554774b3051724a4e466b57436b793931713052437a704647306f7a6e30496b495158546c4a6a4c4d47516453744b31716d627931506f6a6d486948626b414c7845746951466f535547437453684576397954414f4d584938505832736366613263774f47776971474b477a5261334278476965564e74334e6a332b494267507878794362614c6f424d4972426b622f776a6958517248666450387756576f4773556975517252343547506a374d495373557a4250476f5047313547545a665058356b7153746f4e416a63302b496a63554b386c34425164564946427578474b5470656a4842685a6b6253537364464c4d6d4e304d4f5461426d6a576279446c6a4f6b502f59696b69596c672f714251755a7956424b4957597467683534306e42436d54784770454e7a447a6a3652715759412b6a4b3376546b6b46594f7a696f6e6a4236346f697957304b57552b6c72684c7254346e5a4555664144744e41596a3467394e494e577a6e516342575a777174497a45694b773652624245566a456e44494a4634676859456964455975676e54422b54554c374d3367426f3438725551346642733669574533556b49374c3535304445346b716f69475830536a307a566249306e763248726873706751742b5a34436264596967697745465158434e4767736c6d42365349525768414755527053346173537153506e567353456c493570514a774773666b4c316a796d3649447555716a6d30716471724868477163464b566a6a645a59676a41514a612f517866424f66696e2f41363758716777554968696b5a53396a41354e794b31496b4a6d634f5a6c6d507252597844564737424f6a6f3049464e74376b713269524653346c43447377576e7671697a7744612f6f585950644341435936534a357153344a2f484b577365554154385a2b7877736a7162777163594f674541357a742f63314c652f624d6466306b6a4358734c61426879694847394652536d72514b5270523263436775313741705a69536b3931773339316e6870527a32386d47584468452f397a5a637935346578504537393044462b4f54376a462f37354745324c6f316666753346742f7854746761732f633941702f66376f693444394550327945442b57746d326345716344644b6c68524b6b745a516b6c46774270636369745974533771614b634f6f595a576a544d4b36667756436f6e6a43374838477372422b68425168625779534a50436b676242334b426a44454648647170585439556a65414c464a43384a424a6d63664376704c675743436647544f6765433644705867757031367079464a49524954706d374f7837546366643155576d31416e63556a645756745368477a717354575a705652394f6e716d2f432b4e4b6358392f724839656643736f764b64434b6f7357666e62356e6b656d7a73436e53712f41546552685a54434c4a575a5941737641457737537145536c5a4d6345754a7870396d51546b3565393558342b55506174553967786b302b66594d43544330375448384874525375664e335a373934745075736e6162514b3742767a7932706c6d396e6f73377a637a67566f5634424e2f2f646448497253324c42487a6b75776b62645573766b6f6a3458623348346b4667416375333071754a5353745a767151482b7236575a4d6d6f55696552382b7a4136667341316a423731376f4b3232674d7251734f34456c797066775a554c662f66726b6e794f5144794c493577565a6b6b2b7a7a686e31494e4f47587177714261324e6d54613245737a656b6d41346e68436f4b476e45393830382b2b726f4143766875502f51745554336e734a563945503951386333595a576c2f2f6d45304d73706535584172714d3754747a2b4b76777a722f58347077712f7a57796b5944307873584a696c555a41724c4d7537506a6a4357416445324d546b66733551566b574f6d47506b5878323150555836354836585576352f6d6a614c615751336a4e532b48396d2f4f444a796666674f66454675495659615945784e5368594566766a383446344f4c7039304e51665072546676323435587a4b326e49513859776e736b74683879745472384a46676646697a4f6b707035476c56726a4959644b2f5538363743304a474e7332364e42316176656d696b486a6e6e6f707637582b6c79654362362b7932424a586c2b34642b3277645148384b2b4f7a73586569662b6a714578656e4d4a5732313748636135644b4961753735755137734263724f73665048485659762b31544f6c2f58375a2f4b676e734273437664735233744b33486665757274552f4770752f31764832747268345a47526b375a322f2f703445756a7a33705079735357424c6e667a373367382f764f726f5a7a50452f486e697058796765777a2b342f654c68622b702f646c39396f57667063322f612f7738657a49525057456743315141414141424a52553545726b4a6767673d3d, 'png', 1, 'Vicerrectoria', 6, 2, 'fio', 'fio', 'fio', '2019-10-22 08:09:58', '2019-10-22 08:09:58', 'fiorella es una crack', 1, 'No se ha dado de baja', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_edificios`
--

CREATE TABLE `sipa_edificios` (
  `id` int(10) UNSIGNED NOT NULL,
  `sipa_edificios_nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_edificios_cantidad_pisos` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sipa_edificios`
--

INSERT INTO `sipa_edificios` (`id`, `sipa_edificios_nombre`, `sipa_edificios_cantidad_pisos`) VALUES
(1, 'Informatica', 2),
(2, 'Emprendimiento', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_edificios_unidades`
--

CREATE TABLE `sipa_edificios_unidades` (
  `sipa_edificios_unidades_id` int(10) UNSIGNED NOT NULL,
  `sipa_edificios_unidades_nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_edificios_unidades_edificio` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sipa_edificios_unidades`
--

INSERT INTO `sipa_edificios_unidades` (`sipa_edificios_unidades_id`, `sipa_edificios_unidades_nombre`, `sipa_edificios_unidades_edificio`) VALUES
(1, 'contabilidad', 1),
(3, 'secretariado', 1),
(4, 'investigacion', 2),
(5, 'auditorio', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_opciones_menus`
--

CREATE TABLE `sipa_opciones_menus` (
  `sipa_opciones_menu_id` bigint(20) UNSIGNED NOT NULL,
  `sipa_opciones_menu_codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_usuario_creador` int(11) NOT NULL,
  `sipa_opciones_menu_usuario_actualizacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_permisos_roles`
--

CREATE TABLE `sipa_permisos_roles` (
  `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_role` int(11) NOT NULL,
  `sipa_permisos_roles_opciones_menu` int(11) NOT NULL,
  `sipa_permisos_roles_crear` tinyint(1) NOT NULL,
  `sipa_permisos_roles_editar` tinyint(1) NOT NULL,
  `sipa_permisos_roles_ver` tinyint(1) NOT NULL,
  `sipa_permisos_roles_exportar` tinyint(1) NOT NULL,
  `sipa_permisos_roles_usuario_creador` int(11) NOT NULL,
  `sipa_permisos_roles_usuario_actualizacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_roles`
--

CREATE TABLE `sipa_roles` (
  `sipa_roles_id` int(11) NOT NULL,
  `sipa_roles_codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_roles_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_roles_descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_roles_usuario_creador` int(11) NOT NULL,
  `sipa_roles_usuario_actualizacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sipa_roles`
--

INSERT INTO `sipa_roles` (`sipa_roles_id`, `sipa_roles_codigo`, `sipa_roles_nombre`, `sipa_roles_descripcion`, `sipa_roles_usuario_creador`, `sipa_roles_usuario_actualizacion`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Administrador', 'Administrador de toda la informacion general del sistema', 1, NULL, '2019-10-31 08:12:13', NULL),
(2, 'SAdmin', 'Super Administrador', 'Usuario que tiene acceso a todos los features del sistema', 1, NULL, '2019-10-31 08:12:13', NULL),
(3, 'ADM2', 'Administrador2', 'administra', 116570271, NULL, '2019-10-03 11:52:07', '2019-10-03 11:52:07'),
(4, 'func', 'funcionario', 'reserva', 116570271, NULL, '2019-10-03 12:02:59', '2019-10-03 12:02:59'),
(5, 'USUR1', 'usuario1', 'manejo activos', 116570271, NULL, '2019-10-05 04:37:12', '2019-10-05 04:37:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sipa_usuarios_identificacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_usuarios_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_usuarios_telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_usuarios_correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_usuarios_unidad` int(11) DEFAULT NULL,
  `sipa_usuarios_edificio` int(11) DEFAULT NULL,
  `sipa_usuarios_rol` int(11) DEFAULT NULL,
  `sipa_usuarios_usuario_creador` int(11) DEFAULT NULL,
  `sipa_usuarios_usuario_actulizacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `sipa_usuarios_identificacion`, `sipa_usuarios_nombre`, `sipa_usuarios_telefono`, `sipa_usuarios_correo`, `sipa_usuarios_unidad`, `sipa_usuarios_edificio`, `sipa_usuarios_rol`, `sipa_usuarios_usuario_creador`, `sipa_usuarios_usuario_actulizacion`, `created_at`, `updated_at`) VALUES
(1, '123', 'Lea', NULL, 'lea.cardenas@toursys.net', NULL, NULL, NULL, NULL, NULL, '2019-10-01 22:09:32', '2019-10-01 22:09:32'),
(2, '116570271', 'bryan', '85916085', 'bryangarroeduarte@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'asdasd', 'asd', NULL, 'asda', NULL, NULL, NULL, NULL, NULL, '2019-10-04 01:39:15', '2019-10-04 01:39:15'),
(4, 'fiorella', 'Bryan Garro Eduarte', NULL, 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2019-10-05 03:58:18', '2019-10-05 03:58:18'),
(5, '123456789', 'Bryan Garro Eduarte', '70235532', 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2019-10-05 04:09:44', '2019-10-05 04:09:44'),
(6, 'adsasd', 'Bryan Garro Eduarte', NULL, 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2019-10-16 01:35:04', '2019-10-16 01:35:04'),
(7, 'ssss', 'Bryan Garro Eduarte', NULL, 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2019-10-19 06:28:41', '2019-10-19 06:28:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indices de la tabla `sipa_activos`
--
ALTER TABLE `sipa_activos`
  ADD PRIMARY KEY (`sipa_activos_id`),
  ADD KEY `sipa_activos_responsable_fk` (`sipa_activos_responsable`),
  ADD KEY `sipa_activos_encargado_fk` (`sipa_activos_encargado`),
  ADD KEY `sipa_activos_creador_fk` (`sipa_activos_usuario_creador`),
  ADD KEY `sipa_activos_usuario_actualizacion_fk` (`sipa_activos_usuario_actualizacion`);

--
-- Indices de la tabla `sipa_edificios`
--
ALTER TABLE `sipa_edificios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sipa_edificios_nombre_UNIQUE` (`sipa_edificios_nombre`);

--
-- Indices de la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD PRIMARY KEY (`sipa_edificios_unidades_id`),
  ADD KEY `sipa_edificios_unidades_fk_idx` (`sipa_edificios_unidades_edificio`);

--
-- Indices de la tabla `sipa_roles`
--
ALTER TABLE `sipa_roles`
  ADD PRIMARY KEY (`sipa_roles_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sipa_edificios`
--
ALTER TABLE `sipa_edificios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  MODIFY `sipa_edificios_unidades_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sipa_roles`
--
ALTER TABLE `sipa_roles`
  MODIFY `sipa_roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sipa_activos`
--
ALTER TABLE `sipa_activos`
  ADD CONSTRAINT `sipa_activos_usuario_actualizacion_fk` FOREIGN KEY (`sipa_activos_usuario_actualizacion`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD CONSTRAINT `sipa_edificios_unidades_fk` FOREIGN KEY (`sipa_edificios_unidades_edificio`) REFERENCES `sipa_edificios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
