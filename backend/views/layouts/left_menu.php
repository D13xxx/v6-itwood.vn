<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <?php
    $quyenHan = Yii::$app->session->get('quyenHan');
    ?>
    <div class="menu_section">
        <h3>Chức năng hệ thống</h3>
        <?=
        \yiister\gentelella\widgets\Menu::widget(
            [
                "items" => [
                    [
                        'label'=>Yii::t('backend','Quản lý chủ thể'),
                        'url'=>'#',
                        'items'=>[
                            [
                                'label'=>Yii::t('backend','Chủ thể tổ chức'),
                                'icon'=>'bar-chart-o',
                                'url'=>'#',
                                'items'=>[
                                    [
                                        'label'=>Yii::t('backend','Đề nghị duyệt'),
                                        'url'=>['/chu-the/to-chuc/de-nghi-duyet']
                                    ],
                                    [
                                        'label'=>Yii::t('backend','Đã được duyệt'),
                                        'url'=>['/chu-the/to-chuc/da-duoc-duyet'],
                                    ],
                                    [
                                        'label'=>Yii::t('backend','Không được duyệt'),
                                        'url'=>['/chu-the/to-chuc/khong-duoc-duyet']
                                    ]
                                ],
                                'visible' => ($quyenHan!='QUANLYWEBSITE' && $quyenHan!='UBNDXA')
//                                'visible'=>(Yii::$app->user->can('HATKIEMLAM')||
//                                    Yii::$app->user->can('SupperAdmin') ||
//                                    Yii::$app->user->can('UBNDHUYEN')||
//                                    Yii::$app->user->can('CHICUCKIEMLAM')||
//                                    Yii::$app->user->can('TONGCUCKIEMLAM')||
//                                    Yii::$app->user->can('Admin'))
                            ],
                            [
                                'label'=>Yii::t('backend','Chủ thể Hộ gia đình'),
                                'icon'=>'bar-chart-o',
                                'url'=>'#',
                                'items'=>[
                                    [
                                        'label'=>Yii::t('backend','Đề nghị duyệt'),
                                        'url'=>['/chu-the/ho-gia-dinh/de-nghi-duyet']
                                    ],
                                    [
                                        'label'=>Yii::t('backend','Đã được duyệt'),
                                        'url'=>['/chu-the/ho-gia-dinh/da-duoc-duyet'],
                                    ],
                                    [
                                        'label'=>Yii::t('backend','Không được duyệt'),
                                        'url'=>['/chu-the/ho-gia-dinh/khong-duoc-duyet']
                                    ]
                                ],
                                'visible' => ($quyenHan!='QUANLYWEBSITE')
//                                'visible'=>(!Yii::$app->user->can('HATKIEMLAM')$quyenHan=='UBNDXA'||$quyenHan=='UBNDHUYEN')
                            ],
                        ]
                    ],
                    [
                        'label'=>Yii::t('backend','Quản lý Lô rừng'),
                        'url'=>'#',
                        'active'=>Yii::$app->module=='quan-ly-lo-rung',
                        'items'=>[
                            [
                                'label'=>Yii::t('backend','Xét duyệt lô rừng'),
                                'url'=>['/quan-ly-lo-rung/de-nghi-duyet'],
                                'active'=>(Yii::$app->module=='quan-ly-lo-rung' && Yii::$app->controller->id=='de-nghi-duyet'),
                            ],
                            [
                                'label'=>Yii::t('backend','Lô rừng cần phúc tra'),
                                'url'=>['/quan-ly-lo-rung/phuc-tra'],
                                'active'=>(Yii::$app->controller->id=='phuc-tra' && Yii::$app->module=='quan-ly-lo-rung'),
                                'visible'=>($quyenHan!='UBNDXA' && $quyenHan !='UBNDHUYEN' && $quyenHan !='QUANLYWEBSITE')
                            ],
                            [
                                'label'=>Yii::t('backend','Lô rừng đã được duyệt'),
                                'url'=>['/quan-ly-lo-rung/lo-rung-da-duyet'],
                                'active'=>(Yii::$app->controller->id=='lo-rung-da-duyet' && Yii::$app->module=='quan-ly-lo-rung')
                            ],
                            [
                                'label'=>Yii::t('backend','Lô rừng không được duyệt'),
                                'url'=>['/quan-ly-lo-rung/lo-rung-khong-duyet'],
                                'active'=>(Yii::$app->controller->id=='lo-rung-khong-duyet' && Yii::$app->module=='quan-ly-lo-rung')
                            ],
                            [
                                'label'=>Yii::t('backend','Tìm kiếm lô rừng trên Formis'),
                                'url'=>['/quan-ly-lo-rung/tim-tren-formis'],
                                'active'=>(Yii::$app->controller->id=='tim-tren-formis' && Yii::$app->module=='quan-ly-lo-rung')
                            ]
                        ],
                        'visible'=>($quyenHan!='QUANLYWEBSITE'&& $quyenHan!='UBNDHUYEN')
                    ],
                    [
                        'label'=>Yii::t('backend','Đăng ký khai thác'),
                        'url'=>'#',
                        'active'=>Yii::$app->module=='dang-ky-khai-thac',
                        'items'=>[
                            [
                                'label'=>Yii::t('backend','Xét duyệt hồ sơ'),
                                'url'=>['/dang-ky-khai-thac/de-nghi-duyet'],
                                'active'=>(Yii::$app->controller->action->id=='view') && (Yii::$app->module=='dang-ky-khai-thac')
                            ],
                            [
                                'label'=>Yii::t('backend','Hồ sơ đã được duyệt'),
                                'url'=>['/dang-ky-khai-thac/ho-so-duoc-duyet'],
                                'active'=>(Yii::$app->controller->id=='ho-so-duoc-duyet' && Yii::$app->module=='dang-ky-khai-thac')
                            ],
                            [
                                'label'=>Yii::t('backend','Hồ sơ không được duyệt'),
                                'url'=>['/dang-ky-khai-thac/ho-so-khong-duyet'],
                                'active'=>(Yii::$app->controller->id=='ho-so-khong-duyet' && Yii::$app->module=='dang-ky-khai-thac')
                            ],
                        ],
                        'visible'=>($quyenHan!='QUANLYWEBSITE' && $quyenHan!='UBNDHUYEN')
                    ],
                    [
                        'label'=>Yii::t('backend','Hồ sơ gỗ'),
                        'url'=>'#',
                        'active'=>Yii::$app->module=='ho-so-go',
                        'items'=>[
                            [
                                'label'=>Yii::t('backend','Xét duyệt hồ sơ'),
                                'url'=>['/ho-so-go/xet-duyet-ho-so-go'],
                                'active'=>(Yii::$app->controller->action->id=='view') && (Yii::$app->module=='dang-ky-khai-thac')
                            ],
                            [
                                'label'=>Yii::t('backend','Hồ sơ đã được duyệt'),
                                'url'=>['/ho-so-go/ho-so-go-da-duyet'],
                                'active'=>(Yii::$app->controller->id=='ho-so-duoc-duyet' && Yii::$app->module=='dang-ky-khai-thac')
                            ],
                            [
                                'label'=>Yii::t('backend','Hồ sơ không được duyệt'),
                                'url'=>['/ho-so-go/ho-so-khong-duyet'],
                                'active'=>(Yii::$app->controller->id=='ho-so-khong-duyet' && Yii::$app->module=='dang-ky-khai-thac')
                            ],
                        ],
                        'visible'=>($quyenHan!='QUANLYWEBSITE'&&$quyenHan!='UBNDHUYEN'&&$quyenHan!='UBNDXA')
                    ],
                    [
                        'label'=>Yii::t('backend','Danh mục Địa danh'),
                        'url'=>'#',
                        'items'=>[
                            [
                                'label'=>Yii::t('backend', 'Danh sách Tỉnh thành'),
                                'icon'=>'bar-chart-o',
                                'url' => ['/dia-danh-hanh-chinh/tinh-thanh/index'],
                                'active'=>Yii::$app->controller->id=='tinh-thanh'
                            ],
                            [
                                'label'=>Yii::t('backend', 'Danh sách Quận huyện'),
                                'icon'=>'bar-chart-o',
                                'url' => ['/dia-danh-hanh-chinh/quan-huyen'],
                                'active'=>Yii::$app->controller->id=='quan-huyen',
                            ],
                            [
                                'label'=>Yii::t('backend', 'Danh sách Xã phường'),
                                'icon'=>'bar-chart-o',
                                'url' => ['/dia-danh-hanh-chinh/xa-phuong'],
                                'active'=>Yii::$app->controller->id=='xa-phuong'
                            ],
                        ],
                        'visible'=>($quyenHan=='Admin'||$quyenHan=='SupperAdmin')
                    ],
                    [
                        'label'=>Yii::t('backend','Danh mục hệ thống'),
                        'url'=>'#',
                        'items'=>[
                            [
                                'label'=>Yii::t('backend','Quản lý người dùng'),
                                'icon'=>'bar-chart-o',
                                'url'=>'#',
                                'items'=>[
                                    [
                                        'label'=>'Danh sách người dùng',
                                        'url'=>['/user/quan-ly/danh-sach-tai-khoan']
                                    ],
                                    [
                                        'label'=>'Tạo mới người dùng',
                                        'url'=>['/user/quan-ly/tao-tai-khoan']
                                    ]
                                ]
                            ],
                            [
                                'label'=>Yii::t('backend','Loại hình hoạt động'),
                                'icon'=>'bar-chart-o',
                                'url'=>['/danh-muc-chung/loai-hinh-hoat-dong']
                            ],
                            [
                                'label'=>Yii::t('backend','Thông tin trách nhiệm'),
                                'icon'=>'bar-chart-o',
                                'url'=>['/danh-muc-chung/trach-nhiem-tuan-thu']
                            ],
                            [
                                'label'=>Yii::t('backend','Loại Rừng'),
                                'icon'=>'bar-chart-o',
                                'url'=>['/danh-muc-chung/loai-rung']
                            ],
                            [
                                'label'=>Yii::t('backend','Loại Cây'),
                                'icon'=>'bar-chart-o',
                                'url'=>['/danh-muc-chung/loai-cay']
                            ],
                            [
                                'label'=>Yii::t('backend','Kiểu khai thác'),
                                'icon'=>'bar-chart-o',
                                'url'=>['/danh-muc-chung/kieu-khai-thac']
                            ],
                            [
                                'label'=>Yii::t('backend','Quyền sử dụng đất'),
                                'icon'=>'bar-chart-o',
                                'url'=>['/danh-muc-chung/quyen-su-dung-dat']
                            ],
                            [
                                'label'=>Yii::t('backend','Kết nối đến FORMIS'),
                                'icon'=>'bar-chart-o',
                                'url'=>['/danh-muc-chung/ket-noi-formis']
                            ],
                        ],
                        'visible'=>($quyenHan=='Admin'||$quyenHan=='SupperAdmin'),
                    ],
                ],
            ]
        )
        ?>
    </div>
</div>