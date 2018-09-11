<?php
  /* Define page title block */
  $this->start('title');
      switch ($type){
          case "articles":
            if(isset($article->title_header) && trim($article->title_header)!=""){
                $meta_title = isset($article->title_header) ? $article->title_header : $meta_title;
            }else{
                $meta_title = isset($article->title) ? $article->title." - myDr.com.au" : $meta_title;
            }
            break;
          case "tools":
            $meta_title = isset($tool->title) ? $tool->title." - myDr.com.au" : $meta_title;
            break;
          case "cmis":
            $meta_title = isset($cmiProduct->description) ? $cmiProduct->description." - myDr.com.au" : $meta_title;
            break;
          case "sections":
            $meta_title = isset($section->name) ? $section->name." - myDr.com.au" : $meta_title;
            break;
        case "static":
          $meta_title = $page_title." - myDr.com.au";
          break;
          default:
            $meta_title = "myDr.com.au - Health and Medical Information for Australia";
      }
      echo $meta_title;
  $this->end();

  /* Other Default Meta variables */
  $meta_description = "myDr provides comprehensive Australian health and medical information, images and tools covering symptoms, diseases, tests, medicines and treatments, and nutrition and fitness. ";
  $meta_keyword = "health,medical,australia,disease,doctor,medicines,CMIs,treatment,symptoms,body,men's health,women's health,asthma,allergy,heart,blood,cholesterol,cancer,arthitis,diabetes,pregnancy,menopause,travel health,depression,infertility,impotence,baby,babies,child,vaccine,vaccination,anxiety,ulcer,skin,diet,fever,measles,mumps,whooping cough,weight,nutrition,sexual health,mental health,fitness,infection,std,hiv,aids,injury,first aid,obesity";
  $meta_image = "http://www.mydr.com.au/img/mydr_logo.png";
  $meta_type = "article";
  $meta_url = "http://www.mydr.com.au";
  $meta_robots = isset($robots_rule) ? $robots_rule : "index, follow";

  /* Define meta block */
  $this->start('meta');

      switch ($type){
        case "articles": /* ARTICLES META TAGS */
          if(isset($article->section->url)){
            $meta_url = $meta_url."/".$article->section->url."/".$article->url;
          }else{
            $meta_url = $meta_url."/".$article->url;
          }

          echo $this->Html->meta(['rel' => 'canonical', 'link' => $meta_url]);
          echo $this->Html->meta('robots', $meta_robots);

          if ($article->abstract) {
            $abstract_tags_stripped = mb_substr(strip_tags($article->abstract), 0, 200);
            echo(
              $this->Html->meta(
                'description',
                html_entity_decode($abstract_tags_stripped, ENT_QUOTES)
              )
            );
          } else {
            echo(
              $this->Html->meta('description', $meta_description)
            );
          }

          /* OG meta */
          echo $this->Html->meta(['property' => 'og:title', 'content' => $meta_title]);

          if ($article->abstract) {
            $abstract_tags_stripped = mb_substr(strip_tags($article->abstract), 0, 200);
            echo(
              $this->Html->meta([
                'property' => 'og:description',
                'content' => html_entity_decode($abstract_tags_stripped, ENT_QUOTES)
              ])
            );
          } else {
            echo(
              $this->Html->meta([
                'property' => 'og:description',
                'content' => $meta_description
              ])
            );
          }

          echo $this->Html->meta(['property' => 'og:image', 'content' => $article->main_image ?? $meta_image]);
          echo $this->Html->meta(['property' => 'og:type', 'content' => $meta_type]);
          echo $this->Html->meta(['property' => 'og:url', 'content' => $meta_url]);

          echo $this->Html->meta('ArticleID', $article->id);
          echo $this->Html->meta('Active', "True");
          echo $this->Html->meta('ContentType', ucfirst(str_replace('_', ' ',$article->medical_type)));
          $gender = ['', 'Male', 'Female', 'Either'];
          echo $this->Html->meta('ContentGender', $gender[$article->content_gender]);
          echo $this->Html->meta('DC.Creator', $article->author->name);
          echo $this->Html->meta('DC.Publisher', 'myDr');
          echo $this->Html->meta('DC.Title', $meta_title);
          echo $this->Html->meta('DC.Description', $meta_description);
          echo $this->Html->meta('DC.Language', 'en', ['scheme' => 'RFC1766']);
          echo $this->Html->meta('DC.Date.Created', $article->created, ['scheme' => 'ISO8601']);
          echo $this->Html->meta('DC.Date.Issued', $article->created, ['scheme' => 'ISO8601']);
          echo $this->Html->meta('DC.Date.Modified', $article->modified, ['scheme' => 'ISO8601']);
          echo $this->Html->meta('DC.Date.Reviewed', $article->reviewed, ['scheme' => 'ISO8601']);
          echo $this->Html->meta('DC.Type', 'resource', ['scheme' => 'HI Category']);
          echo $this->Html->meta('DC.Type', 'document', ['scheme' => 'HI Type']);
          echo $this->Html->meta('DC.Format', 'text/html', ['scheme' => 'IMT']);
          echo $this->Html->meta('DC.Identifier', $meta_url, ['scheme' => 'URI']);
          $audience = ['', 'Male', 'Female', 'Either'];
          echo $this->Html->meta('AGLS.Audience', $audience[$article->audience], ['scheme' => 'HI age']);
          //echo $this->Html->meta('HI.Complexity', '');
          $hi_status = ['', 'notRegistered', 'Registered'];
          echo $this->Html->meta('HI.Status', $hi_status[$article->hi_status]);

          break;
      case "tools": /* TOOLS META TAGS */
          $meta_url = $meta_url."/tools/".$tool->url;
          echo $this->Html->meta(['rel' => 'canonical', 'link' => $meta_url]);
          echo $this->Html->meta('robots', $meta_robots);
          echo $this->Html->meta('description', $tool->description ?? $meta_description);

          /* OG meta */
          echo $this->Html->meta(['property' => 'og:title', 'content' => $meta_title]);
          echo $this->Html->meta(['property' => 'og:description', 'content' => $tool->description ?? $meta_description]);
          echo $this->Html->meta(['property' => 'og:image', 'content' => $tool->mimage ?? $meta_image]);
          echo $this->Html->meta(['property' => 'og:type', 'content' => 'tool']);
          echo $this->Html->meta(['property' => 'og:url', 'content' => $meta_url]);

          echo $this->Html->meta('ArticleID', $tool->id);
          echo $this->Html->meta('Active', "True");
          echo $this->Html->meta('DC.Creator', $tool->author->name ?? "myDr");
          echo $this->Html->meta('DC.Publisher', 'myDr');
          echo $this->Html->meta('DC.Date.Created', $tool->created, ['scheme' => 'ISO8601']);
          echo $this->Html->meta('DC.Date.Issued', $tool->created, ['scheme' => 'ISO8601']);
          echo $this->Html->meta('DC.Date.Modified', $tool->modified, ['scheme' => 'ISO8601']);
          echo $this->Html->meta('DC.Date.Reviewed', $tool->reviewed, ['scheme' => 'ISO8601']);

      break;
  case "cmis": /* CMIS META TAGS */
        $meta_url = $meta_url."/medicines/cmis/".$cmiProduct->full_url;
        echo $this->Html->meta(['rel' => 'canonical', 'link' => $meta_url]);
        echo $this->Html->meta('robots', $meta_robots);
        echo $this->Html->meta('description', $cmiProduct->description." - Consumer Medicines Information leaflets of prescription and over-the-counter medicines");

        /* OG meta */
        echo $this->Html->meta(['property' => 'og:title', 'content' => $meta_title]);
        echo $this->Html->meta(['property' => 'og:description', 'content' => $cmiProduct->description.' - Consumer Medicines Information leaflets of prescription and over-the-counter medicines']);
        echo $this->Html->meta(['property' => 'og:image', 'content' => $meta_image]);
        echo $this->Html->meta(['property' => 'og:type', 'content' => $meta_type]);
        echo $this->Html->meta(['property' => 'og:url', 'content' => $meta_url]);

        echo $this->Html->meta('DC.Creator', "myDr");
        echo $this->Html->meta('DC.Publisher', 'myDr');
        echo $this->Html->meta('DC.Title', $meta_title);
        echo $this->Html->meta('DC.Description', $cmiProduct->description.'- Consumer Medicines Information leaflets of prescription and over-the-counter medicines');
        echo $this->Html->meta('DC.Language', 'en', ['scheme' => 'RFC1766']);
        echo $this->Html->meta('DC.Format', 'text/html', ['scheme' => 'IMT']);
        echo $this->Html->meta('DC.Identifier', $meta_url, ['scheme' => 'URI']);
        echo $this->Html->meta('DC.Date.Reviewed', date('Y-m-d', strtotime($cmi_issue['dat_data_version'])), ['scheme' => 'ISO8601']);

      break;
      case "sections": /* SECTIONS META TAGS */
        if(isset($section->url)){
          $meta_url = $meta_url."/".$section->url;
        }

        echo $this->Html->meta(['rel' => 'canonical', 'link' => $meta_url]);
        echo $this->Html->meta('robots', $meta_robots);
        echo $this->Html->meta('description', $section->abstract ?? $meta_description);

        /* OG meta */
        echo $this->Html->meta(['property' => 'og:title', 'content' => $meta_title]);
        echo $this->Html->meta(['property' => 'og:description', 'content' => $meta_article->abstract ?? $meta_description]);
        echo $this->Html->meta(['property' => 'og:image', 'content' => $meta_article->main_image ?? $meta_image]);
        echo $this->Html->meta(['property' => 'og:type', 'content' => $meta_type]);
        echo $this->Html->meta(['property' => 'og:url', 'content' => $meta_url]);


        break;
  default:
          echo $this->Html->meta(['rel' => 'canonical', 'link' => $meta_url]);
          echo $this->Html->meta('robots', $meta_robots);

          if(isset($page_title)){
            if($page_title == "Latest Health News"){
              echo $this->Html->meta('description', $meta_description.' - '.$this->Paginator->counter());
            }else{
              echo $this->Html->meta('description', $meta_description);
            }
          }

          /* OG meta */
          echo $this->Html->meta(['property' => 'og:title', 'content' => $meta_title]);
          echo $this->Html->meta(['property' => 'og:description', 'content' => $meta_description]);
          echo $this->Html->meta(['property' => 'og:image', 'content' => $meta_image]);
          echo $this->Html->meta(['property' => 'og:type', 'content' => $meta_type]);
          echo $this->Html->meta(['property' => 'og:url', 'content' => $meta_url]);
      }



  $this->end();
?>
