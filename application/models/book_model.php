<?php
/**
 * Created by PhpStorm.
 * User: Owner
 * Date: 24/04/14
 * Time: 21:36
 */

class book_model {
    public function getFakeBooks()
    {
        $books = array(
            0 => array(
                "name" => "סיכום ביניים",
                "author" => "דוד אבידן",
                "id" => "qYcdAAAAIAAJ",
                "url" => "http://bks2.books.google.co.il/books?id=qYcdAAAAIAAJ&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE70VW5wcR87EV6g2VUrtCR1Tks98Jft0IbXU9L1jfEF2aSxUlJhbudguTEmImOVeOzNWdHt6U6U6bqTBUXmv_lITekk2K81_eZ9p-gIgU3IIdQ9_GaM"
            ),
            1 => array(
                "name" => "דמי מפתח",
                "author" => "יהלי סובול",
                "id" => "Vqq03MSd7QsC",
                "url" => "http://bks1.books.google.co.il/books?id=Vqq03MSd7QsC&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE72jcn3E2eqxBp_FNWbfJ04QSIiscyqU39fjOo1M26QJTr4XqhcBTbsQ5F8PzdBZzVv6P17RNcvMNZROopboo7-9BnaPdPImJpcEItvYb0IOLxrQnzpvCR71HX4xsw5uoQYtlzOy"
            ),
            2 => array(
                "name" => "סיפור על אהבה וחושך",
                "author" => "עמוס עוז",
                "id" => "YD_IqvIbjkUC",
                "url" => "http://bks0.books.google.co.il/books?id=YD_IqvIbjkUC&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE71sVh-_D-ApUZco1Yqq2k6gYN4j93V_jlatVE6ovHdP25oxYsIpNhIVVnkCc08MQqVtYnc715JlFYI2QFDOwLmBTI4rWDgBi76D8H58rt2Vv_h8GrRG_3z7yHz8-QQJBpl95fMG"
            ),
            3 => array(
                "name" => "ארבעה בתים וגעגוע",
                "author" => "אשכול נבו",
                "id" => "jdJSk9QnjqcC",
                "url" => "http://bks5.books.google.co.il/books?id=jdJSk9QnjqcC&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE71XGgl5a5ti2rLWEtHmBL5p4y7wSptdepxJlBJoWBqfGuyFhnG4j5RKv2NqNDo3OyAfR5yXN7_40Pocb65Ay-xEN3kt3Ylz-UD30hCEngKe5RDB9T15_5FirYTu3qIHUrcMPnVH"
            ),
            4 => array(
                "name" => "אם יש גן עדן",
                "author" => "רון לשם",
                "id" => "a8-RcuGzYRUC",
                "url" => "http://bks9.books.google.co.il/books?id=a8-RcuGzYRUC&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE73ECLO8RFXhY_jycIqg-do32FPiUOO2WNzogZEMAwqnk_St86onODrHhJrMpx9lQE9U8wY-Ow46h1vqmx2lvT1Jadoqu_DrMq_PSc3s6kmYef36Y9KzwzX4Pye0NospTQVibm1J"
            ),
            5 => array(
                "name" => "אשתו של הנוסע בזמן",
                "author" => "אודרי ניפנגר",
                "id" => "VYUAu9X_LywC",
                "url" => "http://bks0.books.google.co.il/books?id=VYUAu9X_LywC&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE72xsNf2NPnfW0cykRTtmDyb5s7I3_kqrW1sTMC5PUHKET0IXSDY3p9d_8VtrJj56ny77IB3ICaY2wCAtzPKzgWDAAyYeQOJP5JqwFe1GgcsY15S7ktLD1NhhU0eJpo5bA9-Cj5Y"
            ),
            6 => array(
                "name" => "הידרומניה",
                "author" => "אסף גברון",
                "id" => "7EgLAQAAMAAJ",
                "url" => "http://bks6.books.google.co.il/books?id=7EgLAQAAMAAJ&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE71BA0KyEvi0EHlTCkFJU9VvL8ZPByEu5kEXwkV1K3nfnJOYSTM63w4DiZ6McILEzxngME8GlvNsJKtkvWXgPhyMq15pzWnLD5fCZvUiaocM7QZSO9s"
            ),
            7 => array(
                "name" => "בשבילה גיבורים עפים",
                "author" => "אמיר גוטפרוינד",
                "id" => "FUoLAQAAMAAJ",
                "url" => "http://bks2.books.google.co.il/books?id=FUoLAQAAMAAJ&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE70jurjJEqx4YP3akhXI_eHDXkzWEqoxAzuTHTvlJhs7xa8mlNgN7ewcdExbleVYdAR-7gizwOMrVEspmuYrishxpy_CFlDxttsjeEp6OcvBLxtMmVk"
            ),
            8 => array(
                "name" => "יונה ונער",
                "author" => "מאיר שלו",
                "id" => "MjsOAAAAYAAJ",
                "url" => "http://bks8.books.google.co.il/books?id=MjsOAAAAYAAJ&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE71uc4_9F4NE37g-GorTC1TbaWqHgkD7Xypys8bHzkZEIB7chw96dTmvygLluOMS3kz7p-aEO5sfa8LsBiCzwTV0LTv4Wk5V62s9Yku6vX42DoK-PYE"
            ),
            9 => array(
                "name" => "עולם חדש, מופלא",
                "author" => "אלדוס האקסלי",
                "id" => "GXG1C_7J91IC",
                "url" => "http://bks2.books.google.co.il/books?id=GXG1C_7J91IC&printsec=frontcover&img=1&zoom=1&imgtk=AFLRE715O8RC94EepOsTygh-FN4UduyQyKOWFordIEzhfko8zivtDAP4WrgSqXZ4lD9VBBihSQarqADZjzGBDDdjLxu___LWFql-9AnLceBwrMQ3BBSxlcQyF77eBbiNfBWw4zt70g32"
            ),
            10 => array(
                "name" => "קפקא על החוף",
                "author" => "הרוקו מורקמי",
                "id" => "am-w2EDj0mEC",
                "url" => "http://bks2.books.google.co.il/books?id=am-w2EDj0mEC&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE73fswmf2hd-2KkLGGMFlMblsoDyM_KsZm7nRGrOUBlZqBkJJSvhnfZx2dGm5qn9AQQyjvC9kgHYhSykHuKhJ11ZgvY_yTXnEo1ChBPRz0DG6JO2FJXNjSm4jDT1I5XHrlvLTgpb"
            ),
            11 => array(
                "name" => "סולאריס",
                "author" => "סטינסלב לם",
                "id" => "uMF7Nd52SdAC",
                "url" => "http://bks1.books.google.co.il/books?id=uMF7Nd52SdAC&printsec=frontcover&img=1&zoom=1&edge=curl&imgtk=AFLRE715Y-wsompz8W-iptOm1QY4B-rKVMokZqubVGZdZ_R20AD2BCP3AX1i3PXsWJTUTUmAXZQkg78TKuqssI8Mm1k04YlZvda9boUY2cE-N1dMuqjNZXi3J54DB24QRlNZYoHjEeeM"
            )
        );
        return $books;
    }
} 