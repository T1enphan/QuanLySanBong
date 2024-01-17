<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaiVietSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bai_viets')->delete();
        DB::table('bai_viets')->truncate();

        DB::table('bai_viets')->insert([
            [
                'tieu_de_bai_viet'              => 'HLV tuyển Olympic muốn Messi trở lại',
                'slug_bai_viet'                 => 'HLV tuyển Olympic muốn Messi trở lại',
                'hinh_anh_bai_viet'             => 'https://vcdn-thethao.vnecdn.net/2023/10/27/New-Project-42-3391-1698370014.jpg',
                'mo_ta_ngan_bai_viet'           => 'ARGENTINA-HLV tuyển Olympic Argentina, Javier Mascherano muốn Lionel Messi cùng tham gia giành HC tại Olympic 2024.',
                'mo_ta_chi_tiet_bai_viet'       => '"Tôi đã được hỏi về điều đó và tất nhiên, cánh cửa tuyển Olympic luôn rộng mở cho Leo", Mascherano trả lời khi được hỏi về khả năng Messi trở lại thi đấu cho đội Olympic của Argentina. "Tôi là bạn thân của cậu ấy và tôi rất thích điều đó. Tuy nhiên, trước hết, chúng tôi phải vượt qua vòng loại".

                Đội bóng của Mascherano sẽ dự vòng loại từ giữa tháng 1 đến đầu tháng 2/2024. Argentina nằm cùng bảng B với Uruguay, Chile, Paraguay và Peru, trong khi Brazil, Venezuela, Colombia, Bolivia và Ecuador nằm ở bảng A. Hai đội dẫn đầu mỗi bảng sẽ lọt vào vòng bảng thứ hai. Hai đội dẫn đầu vòng bảng thứ hai sẽ đại diện khu vực Nam Mỹ dự Olympic 2024 tại Pháp vào tháng 7. Hai vòng bảng đều thi đấu theo thể thức vòng tròn một lượt.Chủ tịch Ủy ban Olympic quốc tế, Thomas Bach cũng muốn Messi trở lại Olympic. Năm 2008, tại Bắc Kinh (Trung Quốc), Messi từng giành HC vàng. "Sẽ thật tuyệt nếu Messi có thể thi đấu tại Olympic 2024", Bach nói. "Thế vận hội là tham vọng của nhiều ngôi sao bóng đá, như Kylian Mbappe. Đối với Messi, điều đó đồng nghĩa với cơ hội viết lại lịch sử. Cậu ấy có thể là cầu thủ duy nhất trong lịch sử giành hai HC vàng Olympic và một World Cup".

                Ngoài HC vàng Olympic 2008, Messi còn giành chức vô địch U20 thế giới 2005, Copa America 2021, Siêu Cup Liên lục địa 2022, World Cup 2022, bốn Champions League, 10 La Liga, hai Ligue 1 và bảy Quả Bóng Vàng. Ngày 30/10 tới, Messi có thể sẽ giành Quả Bóng Vàng thứ tám.

                Năm 2024, Messi nhiều khả năng cùng tuyển Argentina tham dự Copa America tại Mỹ, từ 20/6 đến 14/7. Hai tuần sau đó, Olympic sẽ diễn ra. Nếu tham dự cả Copa America và Olympic, Messi có thể không có thời gian phục hồi và thể lực tốt nhất.

                Mascherano từng thi đấu cùng Messi tám năm tại Barca và 13 năm tại tuyển Argentina. Hai danh thủ cùng nhau giành bốn La Liga, bốn Cup Nhà vua, hai Champions League và HC vàng Olympic 2008. Mascherano còn giành HC vàng Olympic 2004, khi Messi chưa thi đấu. Tuyển Olympic gồm các cầu thủ U23 và ba cầu thủ trên độ tuổi này.',
                'the_loai'                      => '0',
                'trang_thai'                    => '1',
            ],
            [
                'tieu_de_bai_viet'              => 'Đội hình Real đắt giá hơn Barca gần 200 triệu USD',
                'slug_bai_viet'                 => 'Đội hình Real đắt giá hơn Barca gần 200 triệu USD',
                'hinh_anh_bai_viet'             => 'https://cdnmedia.webthethao.vn/uploads/2023-03-26/gia-tri-la-liga-barca-real-madrid.jpg',
                'mo_ta_ngan_bai_viet'           => 'Theo Transfermarkt, Real có hai cầu thủ được định giá 158 triệu USD, và sở hữu đội hình đắt giá hơn Barca khoảng 177 triệu USD.',
                'mo_ta_chi_tiet_bai_viet'       => 'Toàn bộ đội hình của Real được định giá 1,09 tỷ USD. Trong đó, Jude Bellingham và Vinicius Junior cao nhất với 158 triệu USD mỗi người. Đây cũng là những cầu thủ đắt giá nhất thế giới, chỉ sau Erling Haaland và Kylian Mbappe với cùng 190 triệu.

                Xếp sau là bộ đôi Rodrygo và Federico Valverde với cùng 105,6 triệu, trong khi hai tiền vệ Pháp Eduardo Camavinga và Auralien Tchouameni được định giá 95 triệu.

                Hai cầu thủ đắt giá nhất trong hàng thủ Real là trung vệ Eder Militao với 74 triệu và thủ môn Thibaut Courtois với 47,5 triệu. Nhưng bộ đôi này đều vắng mặt ở El Clasico ngày mai, vì chấn thương dài hạn và phải nghỉ hết mùa 2023-2024.

                Những cầu thủ Real được định giá thấp nhất là Nacho Fernández, Andriy Lunin (5,3 triệu) và Joselu, Lucas Vazquez (6,35 triệu).Trong khi đó, Transfermarkt định giá toàn bộ đội hình của Barca ở mức 910 triệu USD, thấp hơn Real 177 triệu USD.

                Cầu thủ đắt giá nhất của Barca là Pedri được định giá ở mức 105,6 triệu. Xếp sau là Frenkie de Jong, Gavi (95 triệu), Ronald Araujo (74 triệu), Raphinha, Jules Kounde (63,4 triệu).

                Nhưng Barca được đánh giá cao hơn Real ở khâu đào tạo trẻ. Sau Lamine Yamal (16 tuổi) và Fermin Lopez (20), tiền đạo 17 tuổi Marc Guiu là tài năng tiếp theo từ lò La Masia gây tiếng vang ở đội một khi ghi bàn duy nhất giúp Barca hạ Bilbao 1-0 ở vòng 10 La Liga hôm 22/10. Trước đó, Pedri (20 tuổi), Gavi (19) và Alejandro Balde (20) đã khẳng định được vị trí ở đội một.

                Trận El Clasico đầu tiên của mùa giải sẽ diễn ra ngày 28/10 trên Montjuic - sân nhà của Barca trong lúc Camp Nou được cải tạo. Trong lịch sử, chỉ có một trận El Clasico diễn ra ngày 28/10, là vào mùa giải 2018-2019.

                Tại sân Camp Nou hôm đó, dù vắng Lionel Messi vì chấn thương tay phải, Barca vẫn thắng tưng bừng 5-1 nhờ công Philippe Coutinho, Arturo Vidal cùng cú hat-trick của Luis Suarez. Tác giả bàn thắng duy nhất bên phía Real là hậu vệ Marcelo.

                Đây cũng là lần đầu Barca thắng Real 5-1 kể từ ngày 2/2/1954, khi đoàn quân dưới trướng cố HLV Ferdinand Daucik đánh bại đối thủ nhờ cú đúp của Tejada cùng các pha lập công của Cesar, Moreno và Manchon.

                Marc-Andre ter Stegen là cầu thủ duy nhất của Barca còn sót lại từ trận El Clasico cách đây 5 năm, trong khi Real còn Toni Kroos, Luka Modric, Nacho, Federico Valverde, Dani Ceballos, Courtois và Vazquez.',
                'the_loai'                      => '0',
                'trang_thai'                    => '1',
            ],
            [
                'tieu_de_bai_viet'              => 'Man Utd công bố doanh thu kỷ lục',
                'slug_bai_viet'                 => 'Man Utd công bố doanh thu kỷ lục',
                'hinh_anh_bai_viet'             => 'https://vcdn-thethao.vnecdn.net/2023/10/27/mu-6676-1698375468.jpg',
                'mo_ta_ngan_bai_viet'           => 'ANH-Man Utd đạt doanh thu cao nhất lịch sử bóng đá Anh, dù phải dự Europa League mùa 2022-2023.',
                'mo_ta_chi_tiet_bai_viet'       => 'Hôm 26/10, Man Utd công bố doanh thu năm tài chính từ tháng 7/2022 đến tháng 6/2023 đạt 786,5 triệu USD - phá kỷ lục 760,7 triệu do chính họ thiết lập vào năm 2019. Tuy nhiên, CLB này vẫn báo lỗ 51 triệu USD. Cùng kỳ, Man Utd không chia cổ tức cho chủ sở hữu Glazer.

                Doanh thu kỷ lục của Man Utd đến trong bối cảnh chỉ được dự Europa League 2022-2023, giải đấu kém danh vọng hơn nhiều so với Champions League. Họ dừng bước ở tứ kết giải đấu này, về thứ ba Ngoại hạng Anh, giành Cup Liên đoàn và vào chung kết Cup FA. Sau khi trở lại Champions League, "Quỷ Đỏ" dự báo năm tài chính 2023-2024 sẽ đạt doanh thu từ 788 triệu đến 825 triệu USD.Hóa đơn lương của Man Utd giảm 64 triệu USD, xuống còn 402 triệu USD. Họ giảm được khoản này là do thay đổi đội hình, trong đó có vụ thanh lý hợp đồng với Cristiano Ronaldo. Nợ của Man Utd vẫn ở mức 650 triệu USD như năm tài chính 2021-2022.

                Nhà Glazer muốn bán toàn bộ cổ phần kiểm soát Man Utd từ tháng 11/2022. Tuy nhiên, sau nhiều vòng đấu thầu, không có nhà đầu tư nào trả đến mức giá mà họ mong muốn. Hồi tháng 6, doanh nhân Qatar, Sheikh Jassim đã đưa ra đề nghị cao nhất khoảng sáu tỷ USD và cam kết làm sạch nợ. Đội ngũ của doanh nhân này cũng cho rằng, mức giá mà nhà Glazer đòi hỏi là "hoang đường".

                Đầu tháng 10, theo truyền thông Anh, nhà Glazer chuẩn bị chấp nhận đề nghị 1,6 tỷ USD cho 25% cổ phần từ tỷ phú Jim Ratcliffe. Thương vụ này được xem là bước đầu tiên trong quá trình thâu tóm Man Utd của người có khối tài sản trị giá 18,4 tỷ USD. Sau khi biết tin, Sheikh Jassim đã rút khỏi cuộc đàm phán.

                Sau khi vào Hội đồng Quản trị Man Utd, Ratcliffe nhiều khả năng toàn quyền điều hành mảng bóng đá. Trong khi đó, nhà Glazer vẫn nắm mảng thương mại.

                Nhà Glazer mua Man Utd vào năm 2005, với giá hơn một tỷ USD. Họ vay phần lớn số tiền và sau khi thâu tóm thành công, lập tức chuyển khoản vay cho Man Utd trả dần. Nhiều năm trước, nhà Glazer đều đặn nhận thêm cổ tức từ CLB.',
                'the_loai'                      => '0',
                'trang_thai'                    => '1',
            ],
            [
                'tieu_de_bai_viet'              => 'Cơ thủ Bao Phương Vinh sớm dừng bước tại World Cup',
                'slug_bai_viet'                 => 'Cơ thủ Bao Phương Vinh sớm dừng bước tại World Cup',
                'hinh_anh_bai_viet'             => 'https://vcdn-thethao.vnecdn.net/2023/10/27/bao-phu-o-ng-vinh-jpeg-8911-1698374057.jpg',
                'mo_ta_ngan_bai_viet'           => 'HÀ LAN-Trần Quyết Chiến vào vòng 1/8, nhưng ĐKVĐ thế giới Bao Phương Vinh bị loại ngay vòng bảng World Cup carom 3 băng tại Veghel.',
                'mo_ta_chi_tiet_bai_viet'       => 'Vòng bảng hôm 26/10 có 32 cơ thủ tham dự, trong đó có năm đại diện Việt Nam. Quyết Chiến và Chiêm Hồng Thái đi tiếp, trong khi Nguyễn Trần Thanh Tự, Trần Thanh Lực và Phương Vinh bị loại dù thắng được những đối thủ mạnh.Quyết Chiến ở bảng H với Thanh Tự, Peter Ceulemans và Kim Haeng-jik. Cơ thủ số một Việt Nam thắng Thanh Tự và Ceulemans để đi tiếp sớm một ván đấu, sau đó thua Kim nhưng vẫn đảm bảo đỉnh bảng. Thanh Tự thắng Kim, nhưng thua Ceulemans nên đứng chót bảng và bị loại.

                Hồng Thái ở bảng B với Marco Zanetti, Sam van Etten và Jeong Ye-sung. Ngay ở trận đầu, cơ thủ 24 tuổi đã quật ngã số một thế giới Zanetti tỷ số 40-25 sau 20 lượt cơ. Hồng Thái thua chủ nhà Etten, nhưng sau đó thắng Jeong và đi tiếp với vị trí nhì bảng. Zanetti phải dừng bước bởi ông chỉ thắng một trận trước cơ thủ Hàn Quốc.

                Phương Vinh ở bảng D với Sameh Sidhom, Heo Jung-han và Berkay Karakurt. Ở trận đầu, Phương Vinh thua Heo 24-40 sau 16 lượt cơ. Anh níu cơ hội khi thắng cơ thủ số sáu thế giới Sidhom 40-27 chỉ sau 14 lượt đánh. Tuy nhiên trong trận quyết định, nhà vô địch thế giới 2023 thua Karakurt 36-40 sau 23 lượt cơ. Anh chỉ đứng thứ ba bảng D, sau Karakurt và Heo.

                Thanh Lực cũng gây bất ngờ khi thắng cơ thủ số hai thế giới Cho Myung-woo 40-36 sau 22 lượt cơ ở trận đầu bảng E. Đến trận tiếp theo, anh thua Nikos Polychronopoulos 25-40 chỉ sau 13 lượt cơ, trong đó đại diện Hy Lạp có series ghi tới 25 điểm. Ở lượt cuối, Thanh Lực hòa Barry van Beers nên cả hai tay cơ cùng dừng bước.

                Chỉ có hai cơ thủ đứng đầu mỗi bảng đi tiếp vào vòng 1/8, và cơ thủ số năm thế giới Quyết Chiến tiếp tục là lá cờ đầu của Việt Nam. Anh đang là đương kim vô địch World Cup, và sẽ gặp Polychronopoulos ở vòng 1/8 lúc 17h hôm nay 27/10, giờ Hà Nội.

                Hồng Thái từng vào bán kết World Cup lần gần nhất ở Porto, nhưng thua chính đàn anh Quyết Chiến. Lần này ở vòng 1/8, cơ thủ trẻ sẽ gặp Karakurt, cùng thời điểm với trận của Quyết Chiến.

                World Cup carom 3 băng diễn ra khoảng sáu, bảy lần mỗi năm, là giải uy tín thứ hai trong hệ thống Liên đoàn billiards thế giới (UMB), sau giải VĐTG. Việt Nam đang có đại diện là ĐKVĐ cả World Cup lẫn giải VĐTG. World Cup kỳ này diễn ra ở Veghel, Hà Lan từ 22/10 đến 28/10.',
                'the_loai'                      => '0',
                'trang_thai'                    => '1',
            ],
        ]);
    }
}
