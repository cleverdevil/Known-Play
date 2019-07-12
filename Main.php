<?php

    namespace IdnoPlugins\Play {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->routes()->addRoute('/play/edit/?', '\IdnoPlugins\Play\Pages\Edit');
                \Idno\Core\site()->routes()->addRoute('/play/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\Play\Pages\Edit');
                \Idno\Core\site()->routes()->addRoute('/play/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\Play\Pages\Delete');
                \Idno\Core\site()->routes()->addRoute('/play/([A-Za-z0-9]+)/.*', '\Idno\Pages\Entity\View');
            }

            /**
             * Get the total file usage
             * @param bool $user
             * @return int
             */
            function getFileUsage($user = false) {

                $total = 0;

                if (!empty($user)) {
                    $search = ['user' => $user];
                } else {
                    $search = [];
                }

                if ($plays = Play::get($search,[],9999,0)) {
                    foreach($plays as $play) {
                        if ($play instanceof Play) {
                            if ($attachments = $play->getAttachments()) {
                                foreach($attachments as $attachment) {
                                    $total += $attachment['length'];
                                }
                            }
                        }
                    }
                }

                return $total;
            }

        }

    }
