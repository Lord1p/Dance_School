#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "chttpcontroller.h"
static const QString SETTINGS_FILE_NAME = "config.ini";

MainWindow::MainWindow(QWidget *parent) :
	QMainWindow(parent),
	ui(new Ui::MainWindow),
	settings(SETTINGS_FILE_NAME, QSettings::IniFormat)
{
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		ui->courseTrainer->addItems(CJsonParser::getParser()->getDataList("trainers","trainerName"));
		ui->courseTrainer->setCurrentIndex(settings.value("trainer","").toInt());
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->courseStyle->addItems(CJsonParser::getParser()->getDataList("styles","styleName"));
			ui->courseStyle->setCurrentIndex(settings.value("style","").toInt());
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
	ui->setupUi(this);
	ui->courseName->setText(settings.value("name","").toString());
	ui->coursePrice->setValue(settings.value("price","").toInt());
	ui->courseCountOfPalces->setValue(settings.value("palcescount","").toInt());
	ui->courseDescription->appendPlainText(settings.value("description","").toString());
	ui->courseDuration->setValue(settings.value("duration","").toInt());
}

MainWindow::~MainWindow()
{
	settings.setValue("name",ui->courseName->text());
	settings.setValue("trainer",ui->courseTrainer->currentIndex());
	settings.setValue("style",ui->courseStyle->currentIndex());
	settings.setValue("price",QString("%1").arg(ui->coursePrice->value()));
	settings.setValue("palcescount",QString("%1").arg(ui->courseCountOfPalces->value()));
	settings.setValue("description",ui->courseDescription->toPlainText());
	settings.setValue("duration",QString("%1").arg(ui->courseDuration->value()));
	delete ui;
}

void MainWindow::on_addCourse_2_clicked()
{

	CJsonData::getInstance()->clearData();
	CJsonData::getInstance()->setData("courseName",ui->courseName->text());
	CJsonData::getInstance()->setData("price",QString("%1").arg(ui->coursePrice->value()));
	CJsonData::getInstance()->setData("courseDescription",ui->courseDescription->toPlainText());
	CJsonData::getInstance()->setData("countOfPlaces",QString("%1").arg(ui->courseCountOfPalces->value()));
	CJsonData::getInstance()->setData("duration",QString("%1").arg(ui->courseDuration->value()));
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		auto id = CJsonParser::getParser()->findData("trainers",ui->courseTrainer->currentText(),"trainerId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("trainerId",id);
			CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
		}
	});
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		auto id = CJsonParser::getParser()->findData("styles",ui->courseStyle->currentText(),"styleId");
		if( id != nullptr){
			CJsonData::getInstance()->setData("styleId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/insert/courses.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
}

void MainWindow::on_courseSettings_currentChanged(int index)
{
	switch (index) {
	case 0:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->courseTrainer->clear();
			ui->courseTrainer->addItems(CJsonParser::getParser()->getDataList("trainers","trainerName"));
			ui->courseTrainer->setCurrentIndex(settings.value("trainer","").toInt());
			connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
				CJsonParser::getParser()->disconnect();
				ui->courseStyle->clear();
				ui->courseStyle->addItems(CJsonParser::getParser()->getDataList("styles","styleName"));
				ui->courseStyle->setCurrentIndex(settings.value("style","").toInt());
			});
			CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
		break;
	case 1:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->courseUpdateId->clear();
			ui->courseUpdateId->addItems(CJsonParser::getParser()->getDataList("courses","courseName"));
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/courses.php");
		break;
	case 2:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->courseDeleteName->clear();
			ui->courseDeleteName->addItems(CJsonParser::getParser()->getDataList("courses","courseName"));
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/courses.php");
		break;
	default:
		CJsonParser::getParser()->disconnect();
		break;
	}

}

void MainWindow::on_courseUpdateId_currentIndexChanged(const QString &arg1)
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto courseDescr = ui->courseUpdateId->currentText();
		ui->courseUpdatePrice->setValue(CJsonParser::getParser()->findData("courses",courseDescr,"price").toInt());
		ui->courseUpdateDuration->setValue(CJsonParser::getParser()->findData("courses",courseDescr,"price").toInt());
		ui->courseUpdateCountOfPalces->setValue(CJsonParser::getParser()->findData("courses",courseDescr,"countOfPlaces").toInt());
		ui->courseUpdateDescription->setPlainText(CJsonParser::getParser()->findData("courses",courseDescr,"courseDescription"));
		settings.setValue("courseUpdeteTrainerId",CJsonParser::getParser()->findData("courses",courseDescr,"trainerId"));
		settings.setValue("courseUpdeteStyleId",CJsonParser::getParser()->findData("courses",courseDescr,"styleId"));
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			ui->courseUpdateTrainer->clear();
			ui->courseUpdateTrainer->addItems(CJsonParser::getParser()->getDataList("trainers","trainerName"));
			auto name = CJsonParser::getParser()->findData("trainers",settings.value("courseUpdeteTrainerId","").toString(),"trainerName");
			if(name.length() < 1){
				CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
			} else {
				CJsonParser::getParser()->disconnect();
				ui->courseUpdateTrainer->setCurrentText(name);
				connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
					ui->courseUpdateStyle->clear();
					ui->courseUpdateStyle->addItems(CJsonParser::getParser()->getDataList("styles","styleName"));
					auto styleName = CJsonParser::getParser()->findData("styles",settings.value("courseUpdeteStyleId","").toString(),"styleName");
					if(styleName.length() < 1){
						CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
					} else {
						CJsonParser::getParser()->disconnect();
						ui->courseUpdateStyle->setCurrentText(styleName);
					}
				});
				CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
			}

		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/courses.php");
}

void MainWindow::on_addCourse_3_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonData::getInstance()->setData("courseName",ui->courseUpdateId->currentText());
	CJsonData::getInstance()->setData("price",QString("%1").arg(ui->courseUpdatePrice->value()));
	CJsonData::getInstance()->setData("courseDescription",ui->courseUpdateDescription->toPlainText());
	CJsonData::getInstance()->setData("countOfPlaces",QString("%1").arg(ui->courseUpdateCountOfPalces->value()));
	CJsonData::getInstance()->setData("duration",QString("%1").arg(ui->courseUpdateDuration->value()));
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("courses",ui->courseUpdateId->currentText(),"courseId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("courseId",id);
			connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
				CJsonParser::getParser()->disconnect();
				auto id = CJsonParser::getParser()->findData("trainers",ui->courseUpdateTrainer->currentText(),"trainerId");
				if(id != nullptr){
					CJsonData::getInstance()->setData("trainerId",id);
					connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
						CJsonParser::getParser()->disconnect();
						auto id = CJsonParser::getParser()->findData("styles",ui->courseUpdateStyle->currentText(),"styleId");
						if( id != nullptr){
							CJsonData::getInstance()->setData("styleId",id);
							emit CJsonData::getInstance()->readyToPost();
						}
					});
					CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
				}
			});
			CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/update/courses.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/courses.php");
}

void MainWindow::on_btnRemoveCourse_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("courses",ui->courseDeleteName->currentText(),"courseId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("courseId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/delete/courses.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/courses.php");
}

void MainWindow::on_styleAddButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	CJsonData::getInstance()->setData("styleName",ui->styleAddName->text());
	CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/insert/styles.php",CJsonData::getInstance()->getData());
}

void MainWindow::on_styleUpdateButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	CJsonData::getInstance()->setData("styleName",ui->styleUpdateName_4->text());
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("styles",ui->styleUpdateStyle->currentText(),"styleId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("styleId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/update/styles.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
}

void MainWindow::on_styleDeleteButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("styles",ui->styleUpdateStyle->currentText(),"styleId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("styleId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/delete/styles.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
}

void MainWindow::on_lessonAddbutton_clicked()
{

}

void MainWindow::on_trainerAddButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	CJsonData::getInstance()->setData("trainerName",ui->trainerAddName->text());
	CJsonData::getInstance()->setData("email",ui->trainerAddEmail->text());
	CJsonData::getInstance()->setData("tellNumber",ui->trainerAddNmber->text());
	CJsonData::getInstance()->setData("password",ui->trainerAddPassword->text());
	CJsonData::getInstance()->setData("avatarLink",ui->trainerAddAvatarLink->text());
	CJsonData::getInstance()->setData("trainerDescription",ui->trainerAddDescription->toPlainText());
	CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/insert/trainers.php",CJsonData::getInstance()->getData());
}

void MainWindow::on_trainerUpdateButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	CJsonData::getInstance()->setData("trainerName",ui->trainerUpdateNewName->text());
	CJsonData::getInstance()->setData("email",ui->trainerUpdateEmain->text());
	CJsonData::getInstance()->setData("tellNumber",ui->trainerUpdateNumber->text());
	CJsonData::getInstance()->setData("password",ui->trainerUpdatePassword->text());
	CJsonData::getInstance()->setData("avatarLink",ui->trainerUpdateAvatarLink->text());
	CJsonData::getInstance()->setData("trainerDescription",ui->trainerUpdateDescription->toPlainText());
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("trainers",ui->trainerUpdateName->currentText(),"trainerId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("trainerId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/update/trainers.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
}

void MainWindow::on_trainerDeleteButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("trainers",ui->trainerDeleteName->currentText(),"trainerId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("trainerId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/delete/trainers.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");

}

void MainWindow::on_newsAddButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	CJsonData::getInstance()->setData("header",ui->newsAddHeader->text());
	CJsonData::getInstance()->setData("date",ui->newsAddDate->text());
	CJsonData::getInstance()->setData("text",ui->newsAddBody->toPlainText());
	CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/insert/news.php",CJsonData::getInstance()->getData());

}

void MainWindow::on_newsUpdateButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	CJsonData::getInstance()->setData("header",ui->newsUpdateHeader->text());
	CJsonData::getInstance()->setData("date",ui->newsUpdateDate->text());
	CJsonData::getInstance()->setData("text",ui->newsUpdateDescription->toPlainText());
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("news",ui->newsUpdateNews->currentText(),"newsId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("newsId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/update/news.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/news.php");
}

void MainWindow::on_newsDeleteButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("news",ui->newsDeleteName->currentText(),"newsId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("newsId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/delete/news.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/news.php");
}

void MainWindow::on_roomsAddButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	CJsonData::getInstance()->setData("roomNumber",ui->roomsAddNumber->text());
	CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/insert/rooms.php",CJsonData::getInstance()->getData());
}

void MainWindow::on_roomDeleteButton_clicked()
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto id = CJsonParser::getParser()->findData("rooms",ui->roomDeleteNumber->currentText(),"roomId");
		if(id != nullptr){
			CJsonData::getInstance()->setData("roomId",id);
			emit CJsonData::getInstance()->readyToPost();
		}
	});
	connect(CJsonData::getInstance(),&CJsonData::readyToPost,this,[&](){
		CJsonData::getInstance()->disconnect();
		CHttpController::getInstatnce()->POST("http://localhost/Dance_School/clServer/delete/rooms.php",CJsonData::getInstance()->getData());
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/rooms.php");
}

void MainWindow::on_roomsSettings_currentChanged(int index)
{
	switch (index) {
	case 1:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->roomDeleteNumber->clear();
			ui->roomDeleteNumber->addItems(CJsonParser::getParser()->getDataList("rooms","roomNumber"));
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/rooms.php");
		break;
	default:
		CJsonParser::getParser()->disconnect();
		break;
	}
}

void MainWindow::on_tabWidget_currentChanged(int index)
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	switch (index) {
	case 0:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->courseUpdateId->clear();
			ui->courseUpdateId->addItems(CJsonParser::getParser()->getDataList("courses","courseName"));
			ui->courseDeleteName->clear();
			ui->courseDeleteName->addItems(CJsonParser::getParser()->getDataList("courses","courseName"));
			connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
				CJsonParser::getParser()->disconnect();
				ui->courseTrainer->clear();
				ui->courseTrainer->addItems(CJsonParser::getParser()->getDataList("trainers","trainerName"));
				ui->courseTrainer->setCurrentIndex(settings.value("trainer","").toInt());
				connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
					CJsonParser::getParser()->disconnect();
					ui->courseStyle->clear();
					ui->courseStyle->addItems(CJsonParser::getParser()->getDataList("styles","styleName"));
					ui->courseStyle->setCurrentIndex(settings.value("style","").toInt());
				});
				CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
			});
			CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/courses.php");
		break;
	case 1:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->styleUpdateStyle->clear();
			ui->styleUpdateStyle->addItems(CJsonParser::getParser()->getDataList("styles","styleName"));
			ui->styleDeleteStyle->clear();
			ui->styleDeleteStyle->addItems(CJsonParser::getParser()->getDataList("styles","styleName"));
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/styles.php");
		break;
	case 2:
		//connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		//	CJsonParser::getParser()->disconnect();
		//	ui->lessonUpdateName->addItems(CJsonParser::getParser()->getDataList("lessons","courseName"));
		//	ui->lessonDeleteName->addItems(CJsonParser::getParser()->getDataList("lessons","courseName"));
		//});
		//CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/lessons.php");
		break;
	case 3:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->trainerUpdateName->clear();
			ui->trainerUpdateName->addItems(CJsonParser::getParser()->getDataList("trainers","trainerName"));
			ui->trainerDeleteName->clear();
			ui->trainerDeleteName->addItems(CJsonParser::getParser()->getDataList("trainers","trainerName"));
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
		break;
	case 4:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->newsUpdateNews->clear();
			ui->newsUpdateNews->addItems(CJsonParser::getParser()->getDataList("news","header"));
			ui->newsDeleteName->clear();
			ui->newsDeleteName->addItems(CJsonParser::getParser()->getDataList("news","header"));
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/news.php");

		break;
	case 5:
		connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
			CJsonParser::getParser()->disconnect();
			ui->roomDeleteNumber->clear();
			ui->roomDeleteNumber->addItems(CJsonParser::getParser()->getDataList("rooms","roomNumber"));
		});
		CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/rooms.php");
		break;
	default:
		CJsonData::getInstance()->clearData();
		CJsonParser::getParser()->disconnect();
		CJsonData::getInstance()->disconnect();
		break;
	}
}

void MainWindow::on_trainerUpdateName_currentIndexChanged(int index)
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto trainerName = ui->trainerUpdateName->currentText();
		ui->trainerUpdateNewName->setText(trainerName);
		ui->trainerUpdateEmain->setText(CJsonParser::getParser()->findData("trainers",trainerName,"email"));
		ui->trainerUpdateNumber->setText(CJsonParser::getParser()->findData("trainers",trainerName,"tellNumber"));
		ui->trainerUpdatePassword->setText(CJsonParser::getParser()->findData("trainers",trainerName,"password"));
		ui->trainerUpdateAvatarLink->setText(CJsonParser::getParser()->findData("trainers",trainerName,"avatarLink"));
		ui->trainerUpdateDescription->setText(CJsonParser::getParser()->findData("trainers",trainerName,"trainerDescription"));
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/trainers.php");
}

void MainWindow::on_newsUpdateNews_currentIndexChanged(const QString &arg1)
{
	CJsonData::getInstance()->clearData();
	CJsonParser::getParser()->disconnect();
	CJsonData::getInstance()->disconnect();
	connect(CJsonParser::getParser(),&CJsonParser::dataModified,this,[&](){
		CJsonParser::getParser()->disconnect();
		auto news = ui->newsUpdateNews->currentText();
		ui->newsUpdateHeader->setText(news);
		ui->newsUpdateDescription->setText(CJsonParser::getParser()->findData("news",news,"text"));
		qDebug() << CJsonParser::getParser()->findData("news",news,"date");
		ui->newsUpdateDate->setDate(QDate::fromString(CJsonParser::getParser()->findData("news",news,"date"),"yyyy-MM-dd"));
	});
	CHttpController::getInstatnce()->GET("http://localhost/Dance_School/clServer/get/news.php");
}
