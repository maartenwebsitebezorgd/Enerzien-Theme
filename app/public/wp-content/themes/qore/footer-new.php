<?php

$page_id = is_404() ? 582 : get_the_ID();

$contact = get_field('contact', 'option');
$footer = get_field('footer', 'option');
$footer_cta = get_field('footer_cta', $page_id);

$title = !empty($footer['title']) ? $footer['title'] : 'Kom in contact met Enerzien';
$text = !empty($footer['text']) ? $footer['text'] : 'We helpen graag bij het realiseren van jouw verduurzamingsdoelstellingen';
$image = !empty($footer['image']['ID']) ? wp_get_attachment_image($footer['image']['ID'], 'cta_bg', false, ['class' => 'absolute z-1 top-0 left-0 object-cover object-start rounded-lg h-full w-full']) : '';
$link = !empty($footer['link']) ? $footer['link'] : [
    'title' => 'Neem contact op',
    'target' => '_self',
    'url' => esc_url(home_url('/contact/')),
];
?>

<!-- footer -->
<footer class="bg-gray-800" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="container pb-8 pt-16 sm:pt-24 lg:pt-28">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <!-- company info -->
            <div class="space-y-6">
                <svg class="" height="38" viewBox="0 0 177 38" width="177" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m15.5048941.33590883c.7756471-.44780393 1.7395059-.44795295 2.515153 0l14.2473176 8.22573333c.7757961.44780392 1.2575765 1.28246274 1.2575765 2.17807054v16.4514667c0 .8956079-.4817804 1.7302667-1.2574275 2.1780706l-14.2474666 8.2257333c-.3877491.2239765-.8227373.3358902-1.2575765.3358902s-.8696784-.1119137-1.2575765-.3358902l-14.24731763-8.2257333c-.77564706-.4478039-1.25757647-1.2824627-1.25757647-2.1780706v-16.4514667c0-.8956078.48192941-1.73026662 1.25757647-2.17807054zm12.9544235 7.91890196-11.0094196 6.35643141c-.2128.1227921-.4500392.1841882-.6874274.1841882-.2372392 0-.4746275-.0613961-.6872784-.1841882l-11.00956867-6.35643141-2.5619451 1.47514509c-.53319216.30712942-.86163137.87578822-.86088754 1.49109022l.00342872 2.9564 11.00971769 6.3562823c.4253019.2455843.6872784.6993491.6872784 1.1905177v12.7127137l2.5583686 1.4811059c.2662981.1542353.5635922.2311294.8608863.2311294s.5945882-.0768941.8608863-.2311294l2.5585176-1.4811059v-12.7127137c0-.4910196.2619765-.9449334.6872784-1.1905177l11.0095687-6.3562823.0034287-2.956251c.0007438-.615451-.3276954-1.1841098-.8608876-1.4910902zm-16.7588941 19.48103531-5.00795291 2.8927686 5.00795291 2.8911294zm10.1242432.0029804v5.7810666l5.0076549-2.8911294zm70.209396-14.3894824c.9349491 0 1.8475451.1283059 2.7379373.3840235.8900941.2560157 1.6971843.6959216 2.4209725 1.3188236.7230432.623498 1.3021334 1.4691843 1.7362275 2.5376549.4339451 1.0684706.6395922 2.4039843.6175373 4.0066902l-10.9517491.2004313c0 1.2019922.1502118 2.2819969.4507843 3.2388518.3004236.957302.7956157 1.7143216 1.4857255 2.2704628.6898118.5567372 1.6137334.8348078 2.7714667.8348078.4449726 0 .9516392-.0777882 1.5191059-.2338118.5677647-.1554274 1.1464078-.4172549 1.7363765-.7845882.5895215-.3673333 1.140447-.8623765 1.6529254-1.4858745l1.5024157 1.4022745c-.8012784 1.1352314-1.6584392 1.9982039-2.5708862 2.5878745-.9130432.5901177-1.8198275.9848706-2.7213961 1.185302-.9015686.2002823-1.7310118.3004235-2.4875843.3004235-1.6252079 0-3.0610118-.3619686-4.3072628-1.0851608-1.246847-.7231921-2.2151764-1.7472549-2.9049882-3.0717412-.6902588-1.3241882-1.0349412-2.888298-1.0349412-4.6914949 0-1.5578509.3446824-3.0160078 1.0349412-4.3740235.6898118-1.3574196 1.6638039-2.4542039 2.9216784-3.2888627 1.2572785-.8348079 2.7212471-1.2520628 4.3907137-1.2520628zm56.5951133 0c.934353 0 1.847844.1283059 2.737491.3840235.891137.2560157 1.697333.6959216 2.421568 1.3188236.722745.623498 1.302432 1.4691843 1.736079 2.5376549s.639294 2.4039843.616941 4.0066902l-10.951153.2004313c0 1.2019922.150212 2.2819969.450784 3.2388518.300424.957302.795616 1.7143216 1.485726 2.2704628.689812.5567372 1.613733.8348078 2.772212.8348078.444078 0 .950745-.0777882 1.518509-.2338118.567765-.1554274 1.145961-.4172549 1.736079-.7845882.590117-.3673333 1.14-.8623765 1.652627-1.4858745l1.503608 1.4022745c-.801725 1.1352314-1.658588 1.9982039-2.572078 2.5878745-.912.5901177-1.81953.9848706-2.721098 1.185302-.901569.2002823-1.730118.3004235-2.487436.3004235-1.625208 0-3.061011-.3619686-4.307262-1.0851608-1.246698-.7231921-2.215177-1.7472549-2.904989-3.0717412-.690259-1.3241882-1.034941-2.888298-1.034941-4.6914949 0-1.5578509.344682-3.0160078 1.034941-4.3740235.689812-1.3574196 1.663804-2.4542039 2.921679-3.2888627 1.257278-.8348079 2.721247-1.2520628 4.390713-1.2520628zm-36.427843 0c.778926 0 1.45771.2171216 2.0368.6510667.578494.4340941.868189 1.1410431.868189 2.120251 0 .3339529-.078385.684447-.233812 1.0517804-.156024.3673333-.400565.6737176-.734667.9182588-.333804.2452863-.790251.3673333-1.368894.3673333-.44542 0-.901569-.1336706-1.369043-.4005647-.467326-.2671921-.734518-.7790745-.801279-1.5360941-.445568 0-.890541.1835921-1.335513.5509255-.445718.3673333-.84062.8014274-1.185451 1.3021333-.345428.5010039-.584157.9631137-.717828 1.3857333v5.442524c0 .312047-.011474.7512078-.03338 1.3189725-.022502.5674667-.055882 1.1075137-.100141 1.6193961.35571-.0444078.751208-.0719765 1.185302-.0836.434094-.0108784.762235-.0166902.985019-.0166902v2.5376549h-8.748196v-2.1703216c.623051 0 1.068471-.122047 1.335663-.3673333.267043-.2445412.439161-.5951843.517545-1.0516314.077639-.456.116831-.9736941.116831-1.5526353v-5.6095749c0-.4005647.010879-.851349.033381-1.3522039.021906-.5008549.055286-.995898.100141-1.4858745-.356306.022502-.77371.0390431-1.252063.0502196-.478949.0113255-.840619.0280157-1.085161.0499216v-2.5376549h1.335663c.868039 0 1.663655-.1110196 2.387294-.3338039.723192-.2221883 1.196181-.4449726 1.419114-.6679059h1.636086c.044259.2229333.07764.6401882.100142 1.2522117.021756.6124706.03338 1.1519216.03338 1.6193961.600996-.7346667 1.168612-1.3241882 1.702847-1.7696078.534235-.4451216 1.062808-.7731138 1.586016-.9850196.522909-.2113098 1.05178-.3172628 1.586015-.3172628zm56.594667 0c2.04902 0 3.500471.5844549 4.357333 1.7530667.856863 1.1686118 1.28604 3.0443216 1.28604 5.6260863v4.474269c0 .312047-.011922.7512078-.032785 1.3188235-.022353.5676157-.056627 1.1076628-.101333 1.6195451.37851-.0444078.779372-.0721255 1.202588-.0836.423216-.0108784.745098-.0166902.968628-.0166902v2.5376549h-8.748942v-2.1703216c.622902 0 1.074432-.122196 1.353098-.3673333.277177-.2446902.456-.5951843.533491-1.0517804.07749-.455851.117725-.9735451.117725-1.5526353l-.034274-4.7413121c0-1.4466824-.205647-2.5208157-.616942-3.222102-.412784-.7011372-1.107215-1.0516314-2.087764-1.0516314-.555843 0-1.107216.1224942-1.652628.3671843-.545411.2452863-1.007372.5342353-1.385882.8681883v7.5460102c0 .312047-.010431.7512078-.032784 1.3188235s-.055138 1.1076628-.099844 1.6195451c.356157-.0444078.751059-.0721255 1.184706-.0836.435138-.0108784.762981-.0166902.98502-.0166902v2.5376549h-8.747451v-2.1703216c.622902 0 1.068471-.122196 1.335216-.3673333.266745-.2446902.439608-.5951843.517098-1.0517804.07749-.455851.117725-.9735451.117725-1.5526353v-5.6093513c0-.4007138.010432-.8514981.032785-1.352204.022352-.5008549.055137-.996047.099843-1.4860235-.356157.022651-.773412.0391922-1.251765.0502196-.478353.0113255-.840471.0281647-1.084863.0500706v-2.5376549c1.023765 0 1.891059-.0552863 2.604863-.166902.710823-.1113176 1.274118-.2446902 1.685412-.4007137.411294-.1555765.695921-.3004235.852392-.4340941h1.634745c.044706.2895451.067059.5008549.067059.6343765 0 .1335215.005961.2619764.016392.3840235.011922.1224941.050667.3396157.117725.6510667.444079-.3558589.956706-.6729726 1.536393-.9516393.578196-.2780705 1.156392-.5008549 1.736078-.6677568.578196-.166902 1.089333-.250502 1.534902-.250502zm-30.383906.2002824v11.6531098c0 .312047-.011474.7512078-.03338 1.3189725-.022502.5674667-.055734 1.1075138-.100141 1.6193961.355858-.0444078.751207-.0721255 1.185302-.0836.434094-.0108784.762235-.0166902.985019-.0166902v2.5376549h-8.748196v-2.1703216c.623051 0 1.068471-.122196 1.335663-.3673333.267043-.2446902.439161-.5951843.517545-1.0517804.077639-.455851.116831-.9735451.116831-1.5526353v-5.5427098c0-.4008627.010879-.8623765.03353-1.3855843.021757-.5227608.055286-1.0294274.099992-1.5194039-.356306.022651-.77371.0391921-1.252063.0502196-.478949.0113255-.84062.0281647-1.085161.0500706v-2.5376549c1.023616 0 1.891655-.0552863 2.604267-.166902.712314-.1111686 1.274118-.2446902 1.686306-.4007137.411741-.1555765.695474-.3004235.851498-.4340941zm-8.447474.3339529v2.1035608l-7.445765 10.1171945c-.312047.4229177-.623498.8012784-.934949 1.1352314-.312047.3338039-.623498.6343765-.934949.9015686l4.708125.1335216c.712016.0223529 1.27382-.1555765 1.686008-.5343843.411741-.3782118.728855-.8957569.951639-1.5526353.222338-.6561334.38924-1.3741098.501004-2.1534824h2.070032l-.500855 6.5443451h-14.391122v-2.4041333l7.679726-10.1168965c.378211-.4893804.734666-.9234745 1.068619-1.3022823.333804-.3782118.544965-.6120236.634228-.7011373l-4.507396.0667608c-.512628 0-.929883.1952157-1.252212.5843059-.322926.3896862-.584306.8963529-.784588 1.5192549-.200581.623498-.356604 1.3244862-.467624 2.1035608h-2.070031l.467325-6.444353zm-53.6232161-.5342353c2.0478275 0 3.5003216.5844549 4.3574824 1.7530667.8565647 1.1686118 1.2854431 3.0443216 1.2854431 5.6260863v4.474269c0 .312047-.0116235.7512078-.0333804 1.3188235-.0223529.5676157-.0558823 1.1076628-.1001412 1.6195451.3782118-.0444078.7789255-.0721255 1.2019922-.0836.4224706-.0108784.7453961-.0166902.9683294-.0166902v2.5376549h-8.7481961v-2.1703216c.622902 0 1.0738353-.122196 1.352353-.3673333.2780706-.2446902.455851-.5951843.5342353-1.0517804.0776392-.455851.1168313-.9735451.1168313-1.5526353l-.0333804-4.7413121c0-1.4466824-.2060941-2.5208157-.6176862-3.222102-.4121883-.7011372-1.1076628-1.0516314-2.0868706-1.0516314-.5567373 0-1.1076628.1224942-1.6527765.3671843-.5457098.2452863-1.0075216.5342353-1.3857333.8681883v7.5460102c0 .312047-.0114745.7512078-.0333804 1.3188235-.022502.5676157-.0558824 1.1076628-.1001412 1.6195451.3557098-.0444078.7512079-.0721255 1.185302-.0836.4340941-.0108784.7622353-.0166902.9850196-.0166902v2.5376549h-8.7481961v-2.1703216c.623051 0 1.0684706-.122196 1.3356627-.3673333.2670432-.2446902.4391608-.5951843.5175451-1.0517804.0776393-.455851.1168314-.9735451.1168314-1.5526353v-5.6093513c0-.4007138.0108785-.8514981.0333804-1.352204.0219059-.5008549.0552863-.996047.1001412-1.4860235-.3563059.022651-.7737098.0391922-1.2520628.0502196-.478949.0113255-.8406196.0281647-1.0851607.0500706v-2.5376549c1.0236156 0 1.8916549-.0552863 2.6042666-.166902.7121647-.1113176 1.2741177-.2446902 1.6863059-.4007137.4115922-.1555765.6954745-.3004235.851498-.4340941h1.6360863c.0442588.2895451.0666118.5008549.0666118.6343765 0 .1335215.0052157.2619764.0168392.3840235.0108784.1224941.0500706.3396157.1168314.6510667.4449725-.3558589.9568549-.6729726 1.5359451-.9516393.5784941-.2780705 1.1571372-.5008549 1.7362274-.6677568.5786432-.166902 1.0903765-.250502 1.5359451-.250502zm-13.8899686-6.14363135.2001333 6.47773335h-2.2037019c0-1.2240471-.2117569-2.1481177-.6343765-2.7714667-.4230667-.6229019-.9462745-1.04030587-1.5693255-1.25206273-.623349-.2113098-1.2353725-.30578824-1.8363686-.28388235l-1.2019922.03338039c-.4674745 0-.8683372.0615451-1.2021412.18359216-.3338039.12279215-.5901176.38983529-.767898.80142743-.1783765.4121883-.2671922 1.0517804-.2671922 1.9199686v5.0084h3.9066981l-.1336706-2.9049882h2.5710353v8.1138196h-2.203702c0-.934949-.1451451-1.6079216-.4340941-2.0202588-.2893961-.4114431-.684447-.6728235-1.1853019-.7844392-.5008549-.1111687-1.0517804-.1555765-1.6527765-.1336706l-.8681883.0333804v5.4759788c0 .6009961-.0113254 1.1686118-.0333803 1.7028471-.022353.5342353-.0558824.9462745-.1001412 1.2353725h4.4743137c.6677569 0 1.3130118-.1502118 1.9365098-.4507843.623051-.3004235 1.1352314-.8014275 1.5359451-1.5025647.4007137-.7011373.6011451-1.6527765.6011451-2.8547686h2.1701726l-.166902 7.3457725h-17.6299137v-2.2037019c.5118823-.0220549.9401647-.0888157 1.2855921-.2004314.3448314-.1110196.6120236-.3673334.8012785-.7678981.1889568-.4007137.2838823-1.0461176.2838823-1.9366588v-12.7882219c0-.6008471.0166902-1.1794902.0500706-1.7362275.0333804-.5561412.061098-.97935686.083451-1.26875293-.3563059.02235294-.8012785.03919215-1.3355137.05007058-.5343844.01147451-.9240706.02816471-1.1687608.05007059v-2.57103529zm-54.1605804 12.70496475-6.64955294 3.8408313-.00283264 2.956251c-.00074383.615302.32784441 1.1838118.86103656 1.4909412l2.56224314 1.474549 6.63867448-3.8345725v-3.9596zm16.9404.0014901-3.4065882 1.9669099v3.9628784l6.6309255 3.8266745 2.561498-1.4755922c.5331922-.3071294.8614823-.8759372.8605901-1.4912392l-.0040254-2.956251zm-23.60425882-3.8490274v5.7993961l5.02121568-2.9003687zm30.27109802 0-5.023898 2.9005176 5.023898 2.8991765zm60.3028706-.3765726c-.9796549 0-1.747702.3506432-2.3036941 1.0519295-.5567373.7011372-.9240706 1.6083686-1.102 2.721098h6.1437804c-.022502-.9348-.1502118-1.6746824-.3840235-2.2203922-.2336628-.5451137-.5509255-.9400156-.9514902-1.1853019-.4008628-.2446902-.8683373-.3673334-1.4025726-.3673334zm56.5951133 0c-.979654 0-1.747702.3506432-2.303694 1.0519295-.556737.7011372-.92407 1.6083686-1.102 2.721098h6.143185c-.022353-.9348-.14902-1.6746824-.382981-2.2203922-.233961-.5451137-.551372-.9400156-.952235-1.1853019-.400863-.2446902-.867294-.3673334-1.402275-.3673334zm-132.0425486-13.90993721c-.2974431 0-.5947372.07704314-.8611843.23142746l-2.5582196 1.48155294.0014902 7.64306671 3.4268549 1.9785333 3.4118039-1.9698902-.0013412-7.65305099-2.5588157-1.48065882c-.266149-.15393726-.5634431-.2309804-.8605882-.2309804zm119.0875296 3.65932549c.712165 0 1.307498.26704314 1.786447.80127844.478353.53423529.717827 1.18023529.717827 1.93665882 0 .75701961-.222784 1.40227451-.667757 1.93650976-.445717.5343844-1.046564.8014275-1.803137.8014275-.757019 0-1.380517-.2670431-1.869749-.8014275-.489976-.53423525-.734666-1.17949015-.734666-1.93650976 0-.75642353.255568-1.40242353.768047-1.93665882.511733-.5342353 1.112878-.80127844 1.802988-.80127844zm-114.0253335-1.03002352.0011921 5.78702744 5.0112314-2.89321568zm-10.1242431.01028235-4.99454122 2.88352941 4.99573332 2.88427448z"
                        fill="#055" fill-rule="evenodd"></path>
                </svg>
                <p class="text-base leading-7 text-gray-300">Dé onafhankelijk architect van een slim energiesysteem.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-gray-400">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-400">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-400">
                        <span class="sr-only">Twitter</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-400">
                        <span class="sr-only">GitHub</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-400">
                        <span class="sr-only">YouTube</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0 3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255 0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507 2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            <!-- footer menus column-->
            <div class="mt-16 gap-8 xl:col-span-2 xl:mt-0">
                <!-- footer menus layout-->
                <div class="grid grid-cols-2 gap-x-8 gap-y-16 md:grid-cols-4">
                    <!-- footer menus link list -->
                    <div class="">
                        <h3 class="text-sm font-semibold leading-6 text-white">Wat we doen</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Marketing</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Analytics</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Technische
                                    beoordeling</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Insights</a>
                            </li>
                        </ul>
                    </div>
                    <!-- footer menus link list -->
                    <div class="">
                        <h3 class="text-sm font-semibold leading-6 text-white">Toepassing</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Pricing</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Documentation</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Collectieve
                                    inkoop</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">API Status</a>
                            </li>
                        </ul>
                    </div>
                    <!-- footer menus link list -->
                    <div class="">
                        <h3 class="text-sm font-semibold leading-6 text-white">Voor Wie</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Pricing</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Documentation</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Werken bij
                                    Enerzien</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">API Status</a>
                            </li>
                        </ul>
                    </div>
                    <!-- footer menus link list -->
                    <div class="">
                        <h3 class="text-sm font-semibold leading-6 text-white">Support</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Pricing</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Documentation</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">Werken bij
                                    Enerzien</a>
                            </li>
                            <li>
                                <a href="#" class="text-sm leading-6 text-gray-300 hover:text-white">API Status</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-16 flex items-center justify-between border-t border-white/10 pt-8 sm:mt-20">
            <p class="text-xs leading-5 text-gray-400">&copy; 2024 Enerzien, Inc. All rights reserved.</p>
            <ul role="list" class="flex space-x-4">
                <li>
                    <a href="#" class="text-sm leading-6 text-gray-400 hover:text-white">Voorwaarden</a>
                </li>
                <li>
                    <a href="#" class="text-sm leading-6 text-gray-400 hover:text-white">Cookies</a>
                </li>
                <li>
                    <a href="#" class="text-sm leading-6 text-gray-400 hover:text-white">Privacy</a>
                </li>
            </ul>
        </div>
    </div>
</footer>
<!-- end footer -->

</div>

<?php wp_footer(); ?>

</body>

</html>