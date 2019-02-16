<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="header-layout-<?php _e(Major::$bodyType);?> post-header">
    <div id="layoutImageAble" class="<?php $layoutImageAble = function (){
        $useArray = array(
            "0" => "unUsePostContentImg",
            "1"=>"usePostContentImg"
        );
        switch (Major::$bodyType){
            case "page": case "post":
                if($this->fields->thumbUrl && !empty($this->options->useBlock) && in_array('usePostContentImg', $this->options->useBlock)){
                    return $useArray["1"];
            }
            break; case "index":
                return $useArray["0"];
            break;default:
                return $useArray["0"];
            break;
        }
        return $useArray["0"];
    }; echo $layoutImageAble(); ?>">
        <div class="post-head mdui-color-theme" id="post-image">
            <div class="back">
                <button onclick="historyBack();" class="mdui-btn mdui-btn-icon mdui-ripple"><i class="mdui-icon material-icons">arrow_back</i></button>
            </div>
            <div class="container">
                <?php switch(Major::$bodyType): case "index":?>
                    <div class="title">
                        <h1><?php _e('第 '.$this->_currentPage.' 页 - '); ?><?php $this->options->title(); ?></h1>
                    </div>

                    <?php break; case "page" : case "post":?>
                    <div class="title">
                        <h1><?php $this->sticky(); $this->title(); ?></h1>
                        <div class="subtitle-row1">
                            <span>
                                <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                            </span>
                            <span>
                                <?php $this->category(','); ?>
                            </span>
                            <span>
                                <i class="icon-eye icons"></i>
                                <?php majors_Plugin::theViews(); ?>
                            </span>
                        </div>
                    </div>

                    <?php break; default:?>
                    <div class="title">
                        <h1><?php if($this->_currentPage>1) echo '第 '.$this->_currentPage.' 页 - '; ?><?php $this->archiveTitle(array(
                                'category'  =>  _t('分类 %s'),
                                'search'    =>  _t('包含关键字 %s'),
                                'tag'       =>  _t('标签 %s'),
                                'author'    =>  _t('%s 发布的文章')
                            ), '', ''); ?></h1>
                    </div>

                <?php endswitch; ?>

            </div>
        </div>
        <div class="post-head-row">
            <div class="container">
                <?php switch(Major::$bodyType): case "index":?>
                    <div class="subtitle">
                        <span><?php _e('第 '.$this->_currentPage.' 页'); ?></span>
                    </div>
                    <?php break; case "page" : case "post":?>
                    <div class="subtitle">
                        <div id="post-images"></div>
                        <div class="subtitle-row2">
                            <span>
                                <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                            </span>
                            <?php $this->category(''); ?>
                            <span>
                                <i class="icon-eye icons"></i>
                                <?php majors_Plugin::theViews(); ?>
                            </span>
                        </div>
                    </div>
                    <?php include 'res/layout-postAuthor.php';?>

                    <script>
                        var postImage = document.getElementById("post-images");
                        postImage.innerHTML = '<?php $imageSrc = in_array('usePostContentImg', $this->options->useBlock) ? $this->fields->thumbUrl : ''; $imageSrc = $imageSrc ? '<img id="imageSrc" src="'.$imageSrc.'" alt="'.$this->title.'" />' : ''; echo($imageSrc);?>';
                        function RGBiamge(){
                            if(document.getElementById("imageSrc")){
                                var thumbUrl = "<?php $this->fields->thumbUrl(); ?>";
                                var site = document.domain;
                                var img;
                                if( thumbUrl.indexOf(site) > 0) {
                                    img = thumbUrl;
                                }else{
                                    img = '<?php echo Major::$api['api']."proxy/?proxy="; ?>'+thumbUrl;
                                }
                                RGBaster.colors(img, {
                                    paletteSize: 30, exclude: [ 'rgba(10, 154, 65, 0.97)' ],
                                    success: function(payload){
                                        var postImage = document.getElementById("post-image");
                                        postImage.style.cssText='background-color:'+payload.dominant+'!important;';
                                    }
                                });
                            }
                        }
                        RGBiamge();
                    </script>

                <?php break; default:?>
                    <div class="subtitle">
                        <span><?php echo '第 '.$this->_currentPage.' 页'; ?></span>
                    </div>
                    <?php if($this->is('author')) include 'res/layout-postAuthor.php';?>
                <?php endswitch; ?>
            </div>
        </div>
    </div>
</div>